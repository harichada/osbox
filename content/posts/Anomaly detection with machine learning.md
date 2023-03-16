---
title: "Anomaly detection with machine learning"
date: 2022-09-20
---




Anomaly detection is a machine learning technique used to identify observations that differ significantly from the majority of data. These observations are considered anomalies, outliers or abnormalities. Anomaly detection has broad applications, from fraud detection and intrusion detection in cybersecurity to predictive maintenance in IoT systems. In this post, we'll explore the theory and concepts behind Anomaly Detection, along with code examples in Python to help you understand this important machine learning technique.

## What is Anomaly Detection?
Anomaly Detection is the identification of data points, events, or observations considered rare, unusual, or outside the normal behavior or pattern. These unusual observations might be due to errors, unusual system behavior, or that the data is simply different from what is expected. Anomaly detection plays a crucial role in ensuring data integrity, protecting systems and devices from vulnerabilities, and detecting fraud before any loss occurs.

Anomaly detection can be achieved through machine learning techniques, which can learn from past data to detect unusual patterns or behaviors that might represent anomalies. 

## Types of Anomaly Detection
There are three main types of Anomaly Detection; Unsupervised, Supervised, and Semi-Supervised.

### Unsupervised Anomaly Detection
This method of anomaly detection does not rely on historical labeled data to detect anomalies. Instead, unsupervised techniques make assumptions about data distribution that is different from what is considered normal in the data. These assumptions include the Gaussian distribution, distance methods such as clustering algorithms and density estimation algorithms. 

The most commonly used unsupervised Anomaly Detection algorithms include:
- **K-means clustering** - this algorithm splits the data into k clusters, where each point belongs to the cluster classified by it.
- **Local Outlier Factor (LOF)** - this algorithm measures the density of data points in the data space. It reports a high LOF score for observations that are rare or isolated by a mass of similar objects.
- **One-class SVM** - This algorithm builds a boundary around the entire distribution of the dataset, marking observations on the periphery as anomalous.

Unsupervised anomaly detection techniques can be useful where labelled data is hard to come by or expensive to create.

### Supervised Anomaly Detection
With supervised Anomaly Detection, a model is developed using historical, labeled data as a reference. This requires the collection of data, labeling it as normal or anomalous, fitting a supervised algorithm such as Decision Trees, Random Forests, or even Deep Learning algorithms, then validating the accuracy of the results using the test data set. 

The most commonly used supervised Anomaly Detection algorithms include:
- **Decision Trees** - Decision Trees algorithms work by recursively selecting features to split the data into subsets. It generates a tree model that can be used to vet new data.
- **Random Forests** - This works by fitting multiple decision tree models to subsets of data, then combining them into one model with the highest accuracy.
- **Support Vector Machines (SVM)** - This also builds a boundary around the entire distribution of the dataset, similar to one-class SVM. The SVM algorithm detects any data point that falls outside of the boundary.

In Supervised Learning, the Anomaly Detection algorithm becomes highly secure and accurate. It's, however, costly due to the requirement for labelled data.

### Semi-Supervised Anomaly Detection
Semi-Supervised learning is a combination of supervised and unsupervised learning techniques. This approach mostly uses labeled data, but supplemented with anomalies that are inferred using unsupervised methods. Semi-supervised learning is used in scenarios where a limited amount of labeled data is available, but more unlabeled data is accessible.

## Applications of Anomaly Detection
Anomaly Detection has wide applications in various fields, including cybersecurity, finance, alert systems, and machine health status monitoring. Here are some examples;

### Fraud Detection
Financial institutions and companies use Anomaly Detection algorithms to detect fraud and prevent economic crimes. For example, banks can use Anomaly Detection techniques to detect unusual transaction patterns, such as a sudden increase in spending or an expedited withdrawal of large amounts of cash.

### Cybersecurity
Anomaly Detection techniques, such as machine learning algorithms, can be used to detect unusual behavior on enterprise networks, warning of cyber-attacks, and potential data breaches.

### Predictive Maintenance
Anomaly Detection can help reduce unplanned downtime in industrial applications by detecting unusual machine behavior before they break down. This detection ensures timely preventative maintenance, reducing repair costs and extending capital investments.

## Example in Python
Here is a code example in Python demonstrating the use of the One-class SVM algorithm for Anomaly Detection. We will use the credit card dataset from Kaggle to predict fraudulent activities.

Let's start by installing and importing the necessary libraries:

```python
!pip install pandas numpy matplotlib seaborn sklearn
import pandas as pd
import numpy as np
import matplotlib.pyplot as plt
import seaborn as sns
from sklearn.preprocessing import StandardScaler
from sklearn.svm import OneClassSVM
```

Next, read in the credit card dataset and inspect the data:

```python
df = pd.read_csv('creditcard.csv')
print(df.head())
```

Preprocess the data by scaling the time and amount columns:

```python
df['Normalized Time'] = StandardScaler().fit_transform(df['Time'].values.reshape(-1, 1))
df['Normalized Amount'] = StandardScaler().fit_transform(df['Amount'].values.reshape(-1, 1))
df.drop(['Time', 'Amount'], axis=1, inplace=True)
```

Partition the data into test and train data:

```python
df_train = df.iloc[:170000, :]
df_test = df.iloc[170000:, :]
```

Train the One-class SVM model:

```python
model = OneClassSVM(nu=0.01)
model.fit(df_train[df_train.Class == 0])
```

Predict which observations in the test data are outliers:

```python
y_predict = model.predict(df_test.drop('Class', axis=1))
```

Evaluate the precision score of the model:

```python
from sklearn.metrics import precision_score
precision = precision_score(df_test['Class'], y_predict, average='binary')
print(f"Precision of One-Class SVM model: {precision}")
```

## Conclusion
Anomaly Detection is a useful machine learning technique that helps identify unusual events or data points that differ from what is expected. We have explored the different algorithms that can be used to detect anomalies, including unsupervised, semi-supervised, and supervised learning techniques. We also provide a code example in Python demonstrating the use of One-class SVM algorithm for Anomaly Detection. Anomaly Detection finds applications in various fields, including fraud detection, cybersecurity, and predictive maintenance, and with ongoing improvements in technology, the demand for anomaly detection continues to grow.

## Additional Resources
- [Anomaly Detection in Wireless Sensor Network with K-Means Clustering Algorithm Using Attribute Selection and PCA Techniques](https://www.hindawi.com/journals/am/2017/2149328/)
- [Support Vector Machines-Based Anomaly Detection in Water Monitoring Sensor Networks](https://www.hindawi.com/journals/js/2013/191385/)
- [A Systematic Analysis of Performance Models for Anomaly Detection](https://arxiv.org/abs/2006.06821)