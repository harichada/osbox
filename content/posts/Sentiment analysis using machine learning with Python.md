---
title: "Sentiment analysis using machine learning with Python"
date: 2022-09-20
---




Sentiment analysis is a technique used to determine the attitude or emotional state of a person, organization, or topic by analyzing text data. In recent years, sentiment analysis has gained prominence in many industries, such as marketing and customer service, where it is used to understand customer feedback, detect trends, and make data-driven decisions. In this blog post, we will discuss sentiment analysis using machine learning with Python.

Understanding Sentiment Analysis

Sentiment analysis involves analyzing textual data to determine the sentiment or opinion behind the text. This can be positive, negative, or neutral. Sentiment analysis can be done manually by reading through text and determining the underlying sentiment or by using automated techniques. 

With the rise of machine learning and natural language processing, automated sentiment analysis has become increasingly popular because of its accuracy and speed. Machine learning algorithms are trained on labeled data to recognize patterns and classify sentiment in text data.

Sentiment Analysis Process

The typical sentiment analysis process involves data cleaning, feature extraction, and model training.

Data Cleaning: This involves removing any irrelevant information such as stop words, punctuations, and special characters from the text data.

Feature Extraction: This is the process of converting the raw text data into a more useful format that machine learning algorithms can understand. Some of the features that can be extracted include word frequency, n-grams, and part-of-speech tags.

Model Training: This is where the machine learning algorithm is trained on labeled data. The labeled data is used to teach the algorithm how to recognize patterns and classify sentiment in text data.

Python Libraries for Sentiment Analysis

Python has many libraries that can be used for sentiment analysis. Some of the most common libraries are:

1. Natural Language Toolkit (NLTK): This is a powerful library for processing human language data. NLTK has many tools for tasks such as tokenization, stemming, and part-of-speech tagging.

2. TextBlob: This is another popular library for sentiment analysis. TextBlob is built on top of NLTK and provides an easy-to-use interface for sentiment analysis.

3. Scikit-Learn: This is a general-purpose machine learning library that can be used for sentiment analysis. Scikit-Learn provides many algorithms that can be used for text classification tasks.

Sentiment Analysis using NLTK

Let's explore how to perform sentiment analysis using the Natural Language Toolkit (NLTK) library.

Step 1: Install NLTK

To install NLTK, open your command prompt and enter the command:

```python
   !pip install nltk
```

Step 2: Import NLTK and download the necessary corpora

To use NLTK, you first need to import it and download the necessary corpora. The following code downloads the necessary corpora:

```python
   import nltk
   nltk.download('punkt')
   nltk.download('averaged_perceptron_tagger')
   nltk.download('stopwords')
```

Step 3: Load the Data

Let's load the data that we'll use for sentiment analysis. In this example, we'll use the movie review dataset from NLTK:

```python
   from nltk.corpus import movie_reviews

   # Load positive and negative reviews
   pos_reviews = movie_reviews.fileids('pos')
   neg_reviews = movie_reviews.fileids('neg')
```

Step 4: Data preprocessing

Before we can train the sentiment analysis model, we need to clean and preprocess the data.

```python
   from nltk.tokenize import word_tokenize
   from nltk.corpus import stopwords
   from nltk.stem import WordNetLemmatizer

   stop_words = set(stopwords.words('english'))
   lemmatizer = WordNetLemmatizer()

   def clean_review(review):
       # Tokenize the review
       tokens = word_tokenize(review.lower())

       # Remove stop words
       tokens = [token for token in tokens if token not in stop_words]

       # Lemmatize tokens
       tokens = [lemmatizer.lemmatize(token) for token in tokens]

       # Return clean text
       return ' '.join(tokens)
      
   # Clean positive and negative reviews
   clean_pos_reviews = [clean_review(movie_reviews.raw(review)) for review in pos_reviews]
   clean_neg_reviews = [clean_review(movie_reviews.raw(review)) for review in neg_reviews]
```

Step 5: Data splitting

Before we can train the sentiment analysis model, we need to split the data into training and testing data sets.

```python
   from sklearn.model_selection import train_test_split

   # Split positive and negative reviews into training and testing data
   X_train, X_test, y_train, y_test = train_test_split(
       clean_pos_reviews + clean_neg_reviews,
       ['pos']*len(clean_pos_reviews) + ['neg']*len(clean_neg_reviews),
       test_size=0.2,
       random_state=42,
   )
```

Step 6: Feature extraction

We need to convert the raw text data into a more useful format that machine learning algorithms can understand. For this example, we will use the bag-of-words model to transform the text data into numerical vectors.

```python
   from sklearn.feature_extraction.text import CountVectorizer

   # Create document-term matrix
   vectorizer = CountVectorizer(min_df=5)
   X_train_counts = vectorizer.fit_transform(X_train)
   X_test_counts = vectorizer.transform(X_test)
```

Step 7: Model training

Finally, we can train the sentiment analysis model using the document-term matrix.

```python
   from sklearn.naive_bayes import MultinomialNB
   from sklearn.metrics import accuracy_score

   # Train Multinomial Naive Bayes model
   clf = MultinomialNB()
   clf.fit(X_train_counts, y_train)

   # Predict sentiment of test set
   y_pred = clf.predict(X_test_counts)

   # Print accuracy score
   print(f'Accuracy: {accuracy_score(y_test, y_pred)}')
```

Additional Resources

Sentiment Analysis with Python NLTK, by Sushant Kumar 

Machine Learning Mastery 

Python NLTK Documentation  

In conclusion, sentiment analysis is a useful technique for analyzing text data and understanding the emotional state of a topic, person, or organization. Machine learning algorithms enable automated sentiment analysis with high accuracy and speed. Python has many libraries, including NLTK, that can be used for sentiment analysis. With the right tools and techniques, sentiment analysis can provide valuable insights that can inform decision-making processes across a range of industries.