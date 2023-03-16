---
title: "Building a recommendation engine with Open Source"
date: 2022-09-20
---




Building a Recommendation Engine with Open Source

In today's digital era, businesses are increasingly using recommendation engines to improve customer engagement and retention by providing personalized recommendations. A recommendation engine is a type of machine learning algorithm that provides suggestions to users based on their past activities and interests. In this blog post, we will discuss the various open-source tools and frameworks that can be used to build a recommendation engine.

1. Collaborative Filtering
Collaborative filtering is a commonly used technique in recommendation systems, which discovers patterns in users' activities and derives recommendations from them. The two most popular methods of collaborative filtering are User-based and Item-based filtering.

In User-based filtering, the algorithm uses the past user activities to recommend similar items to the active user. Alternatively, Item-based filtering looks for items that are similar to the items that the active user has interacted before.

Let's look at a code implementation of user-based collaborative filtering using Python and the Pandas library.

``` python
import pandas as pd
from sklearn.neighbors import NearestNeighbors

# Load dataset
movies = pd.read_csv('data/movies.csv')
ratings = pd.read_csv('data/ratings.csv')

# Merge datasets
combined_dataset = pd.merge(movies, ratings, on='movieId')

# Create a pivot table
pivot_table = combined_dataset.pivot_table(index='title', columns='userId', values='rating').fillna(0)

# Train the model
knn = NearestNeighbors(metric='cosine', algorithm='brute')
knn.fit(pivot_table)

# Get recommendations for a user
movie_name = 'Toy Story (1995)'
movie_idx = pivot_table.index.get_loc(movie_name)
distances, indices = knn.kneighbors(pivot_table.iloc[movie_idx, :].values.reshape(1, -1), n_neighbors=6)

for i in range(len(indices.flatten())):
    if i == 0:
        print(f'Recommendations for {movie_name}:')
    else:
        print(f'{i}. {pivot_table.index[indices.flatten()][i]}')
```

2. Content-Based Filtering
Content-based filtering is another popular method in recommendation engines, using past activities and user preferences to recommend similar items. Content-based filtering works by analyzing the metadata of the items, such as genre and actors, to determine the user's interests.

Here's a code snippet for implementing content-based filtering in a Python framework:

``` python
import pandas as pd
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import cosine_similarity

# Load dataset
movies = pd.read_csv('data/movies_metadata.csv')

# Create a feature vector
tfidf = TfidfVectorizer(stop_words='english')
movies['overview'] = movies['overview'].fillna('')
tfidf_matrix = tfidf.fit_transform(movies['overview'])

# Calculate cosine similarity
cosine_similarity = cosine_similarity(tfidf_matrix, tfidf_matrix)
indices = pd.Series(movies.index, index=movies['title']).drop_duplicates()

# Get recommendations for a movie
movie_name = 'Toy Story'
movie_idx = indices[movie_name]
similar_movies = list(enumerate(cosine_similarity[movie_idx]))
sorted_movies = sorted(similar_movies, key=lambda x: x[1], reverse=True)[1:6]
movie_indices = [i[0] for i in sorted_movies]

print(f'Recommendations for {movie_name}:')
for idx in movie_indices:
    print(movies['title'].iloc[idx])
```

3. Singular Value Decomposition (SVD)
SVD is a matrix factorization technique used in recommendation engines to discover latent features and pattern in the data. It reduces the dimensionality of the large user-item matrix.

Here's an implementation of SVD using Python and the Surprise library:

``` python
import pandas as pd
from surprise import SVD, Dataset, Reader
from surprise.model_selection import cross_validate

# Load dataset
ratings = pd.read_csv('data/ratings.csv')

# Load data into Surprise dataset
reader = Reader(rating_scale=(0.5, 5))
data = Dataset.load_from_df(ratings[['userId', 'movieId', 'rating']], reader)

# Train the model
svd = SVD()
cross_validate(svd, data, measures=['RMSE', 'MAE'], cv=5, verbose=True)

# Get recommendations for a user
user_id = 101
rated_movies = ratings[ratings['userId'] == user_id]['movieId']
unrated_movies = set(ratings['movieId']) - set(rated_movies)
predictions = [svd.predict(user_id, movie_id) for movie_id in unrated_movies]
recommendations = sorted(predictions, key=lambda x: x.est, reverse=True)[:5]

print(f'Recommendations for user {user_id}:')
for prediction in recommendations:
    print(prediction.iid)
```

Conclusion
In this blog post, we've covered three popular methods of building recommendation engines: collaborative filtering, content-based filtering, and SVD. We've also demonstrated Python code examples using open-source libraries and frameworks that can be used to implement these techniques.

Additional resources:
- Surprise documentation: https://surprise.readthedocs.io/
- Scikit-learn documentation: https://scikit-learn.org/stable/documentation.html
- TfidfVectorizer documentation: https://scikit-learn.org/stable/modules/generated/sklearn.feature_extraction.text.TfidfVectorizer.html