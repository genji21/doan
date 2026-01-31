from fastapi import FastAPI, HTTPException
from recommender import TourRecommender
import uvicorn

app = FastAPI(title="Travela Tour Recommendation Service")

# Initialize the recommender
# In a production app, you might want to load this asynchronously or on startup event
recommender = TourRecommender()

@app.get("/")
def read_root():
    return {"message": "Welcome to Travela Recommendation Service"}

@app.get("/recommend/{tour_id}")
def get_recommendations(tour_id: int):
    try:
        recommendations = recommender.get_recommendations(tour_id)
        if not recommendations:
             # Even if no recommendations, we might want to return empty list instead of 404
             # But if tour_id is invalid, 404 is appropriate.
             # For now, let's return empty list if valid ID but no similar items (rare),
             # or 404 if ID not in database.
             # Our logic in get_recommendations returns [] if ID not found.
             # Let's check if the ID was actually in the model.
             if tour_id not in recommender.indices:
                  raise HTTPException(status_code=404, detail="Tour ID not found")
             
        return {"tour_id": tour_id, "recommendations": recommendations}
    except Exception as e:
        raise HTTPException(status_code=500, detail=str(e))

@app.post("/reload")
def reload_model():
    """Triggers a reload of the data and retraining of the model."""
    try:
        recommender.load_and_train()
        return {"message": "Model reloaded and trained successfully", "total_tours": len(recommender.df)}
    except Exception as e:
        raise HTTPException(status_code=500, detail=str(e))

if __name__ == "__main__":
    uvicorn.run("main:app", host="0.0.0.0", port=8000, reload=True)
