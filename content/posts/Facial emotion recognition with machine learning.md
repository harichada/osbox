---
title: "Facial emotion recognition with machine learning"
date: 2022-09-20
---




Facial Emotion Recognition with Machine Learning

Facial emotion recognition is the capability of identifying and understanding human emotion by analyzing facial expressions. It is a powerful tool used in various industries, including healthcare, marketing, and entertainment. It involves detecting facial features and mapping them to a particular emotion using machine learning algorithms.

In this blog post, we will explore the basics of facial emotion recognition, and how machine learning plays a crucial role in its development.

Introduction to Facial Emotion Recognition

Facial emotion recognition has been a topic of interest for many years in psychology and neuroscience. However, with the advent of machine learning techniques, it has become possible to automate and enhance the accuracy of facial emotion recognition systems. The overall process of facial emotion recognition involves the following steps:

- Face Detection: The first step is to detect the face in an image or video stream. It involves locating the face using techniques such as Haar Cascade classifiers or deep learning models.

- Feature Extraction: The next step involves extracting key features of the face, such as eye brows, eyes, nose or mouth, and mapping them to particular emotions. Feature extraction techniques include Local Binary Patterns, Histogram of Oriented Gradients, and Convolutional Neural Networks.

- Emotion Detection: The final step is to classify the detected facial features into an emotion, such as happy, sad, angry, or surprised. Machine learning algorithms such as Support Vector Machines, Decision Trees, Random Forests, and Deep Neural Networks are used for emotion classification.

Facial emotion recognition systems can be trained using large datasets that contain annotated images or videos of people displaying different emotions. These datasets enable a machine to learn to recognize and classify emotions from facial expressions with high accuracy.

Implementing Facial Emotion Recognition with Machine Learning

To implement a facial emotion recognition system with machine learning, we can follow the following steps:

- Collect Datasets: The first step involves gathering datasets of facial expressions. These datasets can be collected from various online resources such as FER-2013, CK+, AffectNet, and EmoReact.

- Preprocessing of Images: The next step is to preprocess the images in the dataset. This can include applying filters to reduce noise or distortions, resizing the images to a standard size, and cropping the images to focus only on the face.

- Feature Extraction: The third step involves extracting key features from the images using various techniques such as Local Binary Patterns, Histogram of Oriented Gradients, or Convolutional Neural Networks.

- Model Selection: The fourth step is to select a machine learning algorithm that is suitable for classifying emotions based on the extracted features. This can include Support Vector Machines, Decision Trees, Random Forests, and Deep Neural Networks.

- Model Training: The fifth step involves training the selected machine learning algorithm using the collected datasets.

- Model Evaluation: The final step involves evaluating the trained model's performance using test datasets. Evaluation metrics such as accuracy, precision, recall, and F1 score can be calculated to assess the model's performance.

A sample implementation of facial emotion recognition in Python using the Keras library and the FER-2013 dataset is shown below:

```python
import keras
from keras.models import Sequential
from keras.layers import Dense, Conv2D, MaxPooling2D, Dropout, Flatten
from keras.preprocessing.image import ImageDataGenerator

# Load the FER-2013 dataset
train_data = ImageDataGenerator(rescale=1./255)
train_generator = train_data.flow_from_directory(
        'fer2013/train',
        target_size=(48, 48),
        color_mode='grayscale',
        class_mode='categorical')

# Define the model
model = Sequential()
model.add(Conv2D(32, kernel_size=(3, 3), activation='relu', input_shape=(48,48,1)))
model.add(Conv2D(64, kernel_size=(3, 3), activation='relu'))
model.add(MaxPooling2D(pool_size=(2, 2)))
model.add(Dropout(0.25))
model.add(Conv2D(128, kernel_size=(3, 3), activation='relu'))
model.add(MaxPooling2D(pool_size=(2, 2)))
model.add(Conv2D(128, kernel_size=(3, 3), activation='relu'))
model.add(MaxPooling2D(pool_size=(2, 2)))
model.add(Dropout(0.25))
model.add(Flatten())
model.add(Dense(1024, activation='relu'))
model.add(Dropout(0.5))
model.add(Dense(7, activation='softmax'))

# Compile the model
model.compile(loss='categorical_crossentropy', optimizer=keras.optimizers.Adam(lr=0.0001, decay=1e-6), metrics=['accuracy'])

# Train the model
model.fit_generator(
        train_generator,
        steps_per_epoch=100,
        epochs=15)

# Evaluate the model
test_data = ImageDataGenerator(rescale=1./255)
test_generator = test_data.flow_from_directory(
        'fer2013/test',
        target_size=(48, 48),
        color_mode='grayscale',
        class_mode='categorical')
score = model.evaluate_generator(test_generator)
print('Test loss:', score[0])
print('Test accuracy:', score[1])
```

Summary

Facial emotion recognition is a powerful tool that has gained interest in various industries. Machine learning techniques have played a crucial role in automating and enhancing the accuracy of facial emotion recognition systems. The process involves facial detection, feature extraction, and emotion detection. Machine learning algorithms such as Support Vector Machines, Decision Trees, Random Forests, and Deep Neural Networks are used for emotion classification. Implementing a facial emotion recognition system involves collecting datasets, preprocessing images, feature extraction, model selection, model training, and model evaluation.

Additional Resources:

1. Facial Expression Recognition using Deep Learning: A Comprehensive Review: https://www.sciencedirect.com/science/article/pii/S2090447919302864
2. Emotion Recognition Using Facial Landmarks, Python, DLib and OpenCV: https://towardsdatascience.com/emotion-recognition-using-facial-landmarks-python-dlib-and-opencv-2d37315b0055
3. FER-2013: Facial Expression Recognition Dataset:https://www.kaggle.com/c/challenges-in-representation-learning-facial-expression-recognition-challenge/data