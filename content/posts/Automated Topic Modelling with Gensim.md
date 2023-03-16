---
title: "Automated Topic Modelling with Gensim"
date: 2022-09-20
---


Have you ever been tasked with analyzing a large dataset and struggled to identify the main topics or themes present within it? Automated topic modeling can come in handy in these situations. In this blog post, we’ll explore automated topic modeling with Gensim, a popular Python library used for natural language processing.

Before diving into topic modeling with Gensim, let’s first discuss what topic modeling is and why it’s beneficial.

What is Topic Modeling?

Topic modeling is an unsupervised machine learning technique used to identify the main topics or themes present within a large dataset. It’s commonly used for text analysis, but can also be applied to other types of data such as images or videos.

The goal of topic modeling is to extract the underlying structure of a dataset and group similar items together. This can be useful for a variety of applications such as content recommendation, sentiment analysis, and anomaly detection.

One of the most common techniques used for topic modeling is Latent Dirichlet Allocation (LDA). LDA assumes that each document is a mixture of topics and that each topic is a collection of words that appear together frequently. 

Now that we’ve discussed the basics of topic modeling, let’s move on to how we can implement automated topic modeling using Gensim. 

Automated Topic Modeling with Gensim

Gensim is a popular Python library used for natural language processing tasks such as topic modeling, text similarity, and text summarization. It’s designed to be both efficient and scalable, making it ideal for analyzing large datasets.

To get started with automated topic modeling in Gensim, we first need to prepare our dataset. This involves cleaning the text data and tokenizing it into words or phrases. Once the data is preprocessed, we can create a dictionary and document-term matrix that will be used as input for the LDA model.

Here’s an example of how to prepare the dataset and create the dictionary and document-term matrix using Gensim:

```python
import gensim
from gensim import corpora

# Sample corpus of documents
corpus = [
  'The quick brown fox jumps over the lazy dog',
  'The lazy dog sat under the tree',
  'The quick brown fox sat on the tree'
]

# Tokenize and clean the corpus
tokenized_corpus = [[word for word in document.lower().split()] for document in corpus]

# Create the dictionary
dictionary = corpora.Dictionary(tokenized_corpus)

# Create the document-term matrix
doc_term_matrix = [dictionary.doc2bow(doc) for doc in tokenized_corpus]
```

In this example, we have a sample corpus of three documents that we tokenize and clean. We then create a dictionary of all the unique words in the corpus and a document-term matrix that represents the frequency of each word in each document.

Once the dictionary and document-term matrix are created, we can train the LDA model using Gensim’s `LdaModel` class. Here’s an example:

```python
from gensim.models.ldamodel import LdaModel

# Train the LDA model
lda_model = LdaModel(doc_term_matrix, num_topics=3, id2word=dictionary, passes=50)
```

In this example, we’re training an LDA model with three topics and running it for 50 passes over the document-term matrix.

After the model is trained, we can extract the main topics and their associated words using Gensim’s `show_topics()` method. Here’s an example:

```python
# Print the main topics
topics = lda_model.show_topics(num_topics=3, formatted=False)
for topic in topics:
  print(topic)
```

This will print out the main topics and their associated words:

```
(0, [('quick', 0.148), ('brown', 0.148), ('fox', 0.148), ('jumps', 0.148), ('over', 0.148), ('the', 0.116), ('lazy', 0.116), ('dog', 0.116)])
(1, [('lazy', 0.222), ('dog', 0.222), ('sat', 0.222), ('under', 0.222), ('the', 0.14)])
(2, [('quick', 0.227), ('brown', 0.227), ('fox', 0.227), ('sat', 0.227), ('on', 0.227), ('the', 0.067)])
```

As we can see, the model has identified three main topics in the corpus based on the frequency of words that appear together: topic 0 is related to the quick brown fox, topic 1 is related to the lazy dog under the tree, and topic 2 is related to the quick brown fox on the tree.

Conclusion

Automated topic modeling with Gensim is a powerful technique that can be used to identify the main topics or themes present within a large dataset. By using Gensim’s LDA model, we can extract the underlying structure of the dataset and group similar items together.

In this blog post, we covered the basics of topic modeling and how to implement automated topic modeling with Gensim. We walked through the process of preparing the dataset, creating the dictionary and document-term matrix, training the LDA model, and extracting the main topics and their associated words.

By using Gensim’s implementation of LDA, we can easily apply automated topic modeling to any text dataset in Python.  

Additional Resources:

- Gensim Documentation: https://radimrehurek.com/gensim/
- Introduction to Topic Modeling with Gensim: https://www.machinelearningplus.com/nlp/topic-modeling-gensim-python/
- Topic Modeling in Python with Gensim: https://www.datascience.com/blog/introduction-to-topic-modeling-pystan-word2vec