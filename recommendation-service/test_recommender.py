from recommender import TourRecommender
import time

def test():
    print("Initializing Recommender...")
    start = time.time()
    rec = TourRecommender()
    print(f"Initialization took {time.time() - start:.2f} seconds.")

    if rec.df is None or rec.df.empty:
        print("FAIL: No data loaded from database.")
        return

    print(f"Loaded {len(rec.df)} tours.")
    
    # Pick the first tour ID
    if len(rec.df) > 0:
        first_tour_id = rec.df.iloc[0]['tourId']
        print(f"\nTesting recommendations for Tour ID: {first_tour_id}")
        recommendations = rec.get_recommendations(first_tour_id, limit=3)
        print("Recommendations found:", recommendations)
    else:
        print("No tours to test.")

if __name__ == "__main__":
    test()
