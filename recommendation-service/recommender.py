import os
import pandas as pd
import mysql.connector
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import linear_kernel
from dotenv import load_dotenv

load_dotenv()

class TourRecommender:
    def __init__(self):
        self.connection_params = {
            'host': os.getenv('DB_HOST', '127.0.0.1'),
            'port': int(os.getenv('DB_PORT', 3306)),
            'user': os.getenv('DB_USERNAME', 'root'),
            'password': os.getenv('DB_PASSWORD', ''),
            'database': os.getenv('DB_DATABASE', 'travela')
        }
        self.df = None
        self.cosine_sim = None
        self.indices = None
        
        # Load data immediately upon initialization
        self.load_and_train()

    def load_data(self):
        """Fetches tour data from MySQL database."""
        try:
            conn = mysql.connector.connect(**self.connection_params)
            
            # Fetch basic tour info
            query_tours = "SELECT tourId, title, description, destination, priceAdult FROM tbl_tours"
            self.df = pd.read_sql(query_tours, conn)
            
            # Fetch average ratings
            query_ratings = """
                SELECT tourId, AVG(rating) as rating 
                FROM tbl_reviews 
                GROUP BY tourId
            """
            df_ratings = pd.read_sql(query_ratings, conn)
            
            # Fetch images
            query_images = "SELECT tourId, imageUrl FROM tbl_images"
            df_images = pd.read_sql(query_images, conn)
            
            conn.close()

            # Merge ratings
            if not df_ratings.empty:
                self.df = pd.merge(self.df, df_ratings, on='tourId', how='left')
                self.df['rating'] = self.df['rating'].fillna(0) # Default rating 0 if none
            else:
                self.df['rating'] = 0

            # Group images by tourId
            if not df_images.empty:
                images_grouped = df_images.groupby('tourId')['imageUrl'].apply(list).reset_index(name='images')
                # Merge images
                self.df = pd.merge(self.df, images_grouped, on='tourId', how='left')
            else:
                self.df['images'] = None
            
            # Fill empty images with empty list where NaN
            # We use a small loop or map because fillna([]) is deprecated/tricky
            self.df['images'] = self.df['images'].apply(lambda x: x if isinstance(x, list) else [])

            print(f"Loaded {len(self.df)} tours from database.")
        except Exception as e:
            print(f"Error loading data: {e}")
            self.df = pd.DataFrame()

    def train(self):
        """Vectorizes data and calculates cosine similarity."""
        if self.df is None or self.df.empty:
            print("No data to train on.")
            return

        # Preprocessing
        # Combine relevant text fields
        self.df['content'] = self.df['title'].fillna('') + ' ' + \
                             self.df['description'].fillna('') + ' ' + \
                             self.df['destination'].fillna('')
        
        # TF-IDF Vectorization
        tfidf = TfidfVectorizer(stop_words='english') 
        
        tfidf_matrix = tfidf.fit_transform(self.df['content'])
        
        # Compute Cosine Similarity
        self.cosine_sim = linear_kernel(tfidf_matrix, tfidf_matrix)
        
        # Create a reverse map of indices and tour titles/IDs
        self.indices = pd.Series(self.df.index, index=self.df['tourId']).drop_duplicates()
        print("Model trained successfully.")

    def load_and_train(self):
        self.load_data()
        self.train()

    def get_recommendations(self, tour_id, limit=5):
        """Returns a list of recommended tours for a given tour_id."""
        if self.df is None or self.df.empty or self.cosine_sim is None:
            return []

        # Check if tour_id exists
        if tour_id not in self.indices:
            return []

        # Get the index of the tour that matches the tour_id
        idx = self.indices[tour_id]

        # Get the pairwsie similarity scores of all tours with that tour
        sim_scores = list(enumerate(self.cosine_sim[idx]))

        # Sort the tours based on the similarity scores
        sim_scores = sorted(sim_scores, key=lambda x: x[1], reverse=True)

        # Get the scores of the 10 most similar tours (excluding itself)
        sim_scores = sim_scores[1:limit+1]

        # Get the tour indices
        tour_indices = [i[0] for i in sim_scores]

        # Return the top most similar tours
        return self.df.iloc[tour_indices][['tourId', 'title', 'destination', 'priceAdult', 'images', 'rating']].to_dict('records')
