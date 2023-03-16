+++
title = "Predicting house prices using AI"
date = "2022-11-16"
+++
+++
title = "Predicting house prices using AI"
date = "2022-12-03"
+++


Predicting House Prices Using AI

Are you interested in developing an impressive project that utilizes AI, ML, and open-source hardware and software? In this blog post, we will guide you step-by-step through the process of creating a project that utilizes these technologies to predict house prices based on given information. We’ll cover everything from selecting the appropriate hardware and software to writing code snippets that will bring your project to life. Even if you are a beginner or an experienced programmer, this blog post will provide you with the necessary knowledge and tools to kick-start your AI project. 

Project Overview 

The purpose of this project is to demonstrate how we can use AI and ML technologies to predict house prices based on several factors, such as square footage, the number of bedrooms, the number of bathrooms, and the location of the house. We will use a dataset with details of past house sales to train our AI model. Once trained, we can then use the model to predict house prices.

Hardware Requirements 

In this project, we will use a Raspberry Pi 4, a 32GB SD card, and a 7-inch touchscreen display. The Raspberry Pi 4 is an affordable and powerful single-board computer that is ideal for AI and ML projects. 

Software Requirements 

We will be using Python, TensorFlow, Keras, and OpenCV for this project. TensorFlow and Keras are two of the most widely used libraries for developing ML and AI applications. OpenCV is an open-source computer vision library that provides various image processing functions.  

Data Preparation 

We will begin by collecting and preparing our dataset. The dataset we will be using contains information on houses sold in a particular area between 2014 and 2015. The dataset has six relevant features, such as price, number of bedrooms, square footage, and location. The first step is to load and clean the data.

Here's the code to load and clean the dataset: 

```
import pandas as pd

housing_data = pd.read_csv("housing_data.csv")

housing_data = housing_data.dropna()

housing_data = housing_data[["price", "bedrooms", "bathrooms", "sqft_lot", 
                             "sqft_above", "sqft_living", "floors", 
                             "condition", "lat", "long"]]

```

Training the Model 

The next step is to train our AI model on the data. We will use TensorFlow and Keras for this task. We’ll use a sequential model with three hidden layers, which is ideal for this type of prediction. Here's the code to create the model:

```
import tensorflow as tf
from tensorflow import keras

model = keras.Sequential()

model.add(keras.layers.Dense(64, activation='relu', input_dim=9))
model.add(keras.layers.Dense(64, activation='relu'))
model.add(keras.layers.Dense(1, activation='linear'))

model.compile(loss='mse', optimizer='adam')
```

The above code creates a neural network model with three layers. The first layer has 64 neurons, the second layer has 64 neurons, and the third layer has one neuron. We used the “mse” loss function, as it is an appropriate loss function for this type of prediction.

We then need to split the dataset into training and testing sets. We'll use 80% of the data for training and 20% for testing.

```
from sklearn.model_selection import train_test_split

X_train, X_test, y_train, y_test = train_test_split(
    housing_data.drop("price", axis=1), housing_data["price"], test_size=0.2, random_state=42
)
```

Finally, we can train the model using the fit() function:

```
history = model.fit(X_train, y_train, epochs=100)
```

Building the User Interface 

The final step is to create a user interface that allows users to input the required house features and get a prediction of the house price. We'll use OpenCV to capture images from the Raspberry Pi camera and use the data to feed into the model. 

First, we create a window with OpenCV where users can input the values. 

```
import cv2
import numpy as np

#create a new window for input
cv2.namedWindow("Input Window")

#create a callback function to update the model when the submit button is pressed
def submit_callback(*args):
    house = [bedroom_slider.get(),
             bathroom_slider.get(),
             sqft_lot_slider.get(),
             sqft_above_slider.get(),
             sqft_living_slider.get(),
             floors_slider.get(),
             condition_slider.get(),
             lat_slider.get(),
             long_slider.get()]
             
    house = np.array(house).reshape(1,-1)

    #use the model to make a prediction
    price_prediction = model.predict(house)
     
    #write the result to the output window
    output_text.set(" Price prediction: $%.2f" %price_prediction.tolist()[0][0])
    
#create sliders for the features
bedroom_slider = Scale(input_frame, from_=0, to=10, label="Bedrooms")
bathroom_slider = Scale(input_frame, from_=0, to=10, label="Bathrooms")
sqft_lot_slider = Scale(input_frame, from_=0, to=400, label="Square Footage Lot")
sqft_above_slider = Scale(input_frame, from_=0, to=5000, label="Square Footage Above")
sqft_living_slider = Scale(input_frame, from_=0, to=10000, label="Square Footage Living")
floors_slider = Scale(input_frame, from_=0, to=5, label="Number of Floors")
condition_slider = Scale(input_frame, from_=0, to=5, label="Condition")
lat_slider = Scale(input_frame, from_=-90, to=90, label="Latitude")
long_slider = Scale(input_frame, from_=-180, to=180, label="Longitude")

bedroom_slider.pack()
bathroom_slider.pack()
sqft_lot_slider.pack()
sqft_above_slider.pack()
sqft_living_slider.pack()
floors_slider.pack()
condition_slider.pack()
lat_slider.pack()
long_slider.pack()
```

Conclusion 

In this project, we showed how you can use AI and ML technologies to predict house prices based on various home features. We used a dataset with past house sales to train our model and created a user interface that users can use to input required details and get a predicted house price. We hope this blog post has been informative and useful in helping you create an AI and ML project. 

This was a brief overview of how you can start a project based on AI to help predict house prices. For more detailed instructions and in-depth features, you can visit this repository: https://github.com/MicrosoftDocs/aiml-ml-bankmortgage.
