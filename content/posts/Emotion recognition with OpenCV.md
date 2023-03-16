---
title: "Emotion recognition with OpenCV"
date: 2022-09-20
---




Emotion Recognition with OpenCV: An Overview

Emotion recognition is a computer vision technique that involves detecting and interpreting human emotions from visual data, typically facial expressions. It is a complex task that requires analyzing various facial features such as the shape and orientation of the eyebrows, eyes, mouth, and nose, as well as factors like the person's skin color, age, and gender.

OpenCV (Open Source Computer Vision Library) is a widely used open-source computer vision library that provides various features to analyze and manipulate visual data. It can be used for emotion recognition by utilizing its facial recognition and tracking capabilities, along with machine learning algorithms.

In this post, we will explore the process of emotion recognition with OpenCV, from detecting facial landmarks to training a machine learning model. We will also provide code snippets for illustration and links to additional resources for readers to learn more.

Detecting Facial Landmarks

Before we can recognize emotions, we need to detect and locate key facial landmarks on the person's face. This process involves identifying the eyes, nose, mouth, and other relevant features and mapping their positions relative to each other.

OpenCV provides various face detection algorithms, such as Haar cascades, that can detect faces in an image or video stream. Once we have located a face, we can use facial landmark detection algorithms, such as the shape predictor model from dlib, to identify individual facial features.

Below is a sample code snippet that demonstrates facial landmark detection with OpenCV and dlib:

```
import cv2
import dlib

# Load face detector and landmark predictor
detector = dlib.get_frontal_face_detector()
predictor = dlib.shape_predictor('shape_predictor_68_face_landmarks.dat')

# Load image and convert to grayscale
img = cv2.imread('face.jpg')
gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)

# Detect faces and landmarks
faces = detector(gray)
for face in faces:
    landmarks = predictor(gray, face)

    # Draw landmarks on image
    for i in range(68):
        x, y = landmarks.part(i).x, landmarks.part(i).y
        cv2.circle(img, (x, y), 2, (0, 0, 255), -1)

# Display image with landmarks
cv2.imshow('Facial Landmarks', img)
cv2.waitKey(0)
cv2.destroyAllWindows()
```

In this code snippet, we first load the face detector and landmark predictor models from dlib. We then load an image, convert it to grayscale, and detect faces using the detector. For each face detected, we compute facial landmarks using the predictor and draw circles around each landmark on the image.

This code produces an output image that shows the facial landmarks detected in the input image. This process is crucial for emotion recognition since it provides the necessary data to analyze and interpret facial expressions.

Analyzing Facial Expressions

Once we have detected facial landmarks, we can use that data to analyze the person's facial expression and determine their emotion. There are various approaches for this task, including rule-based methods, feature-based methods, and machine learning-based methods.

Rule-based methods involve manually defining rules or thresholds for detecting specific facial expressions. For example, we could define that a raised eyebrow and a mouth slightly open indicate surprise. While this approach can be effective, it is limited since it requires precise rules for each expression and may not be robust to variations in the data.

Feature-based methods involve extracting relevant features from the facial landmarks and using them to train a model that can classify emotions. Some examples of features that can be extracted include the distance between the eyebrows, the curvature of the lips, and the angle of the mouth corners.

Machine learning-based methods involve training a model that can learn to recognize emotions directly from the facial landmarks. There are various machine learning algorithms that can be used for this task, including support vector machines (SVM), decision trees, and neural networks.

Below is a code snippet that demonstrates a simple machine learning-based emotion recognition approach using SVM in OpenCV:

```
import cv2
import dlib
from sklearn.svm import SVC
from sklearn.decomposition import PCA
import numpy as np

# Load face detector and landmark predictor
detector = dlib.get_frontal_face_detector()
predictor = dlib.shape_predictor('shape_predictor_68_face_landmarks.dat')

# Load labeled emotion data
emotions = ['neutral', 'happy', 'sad', 'surprise', 'anger']
X = np.load('x_data.npy')
y = np.load('y_data.npy')

# Perform PCA on data
pca = PCA(n_components=50)
X_pca = pca.fit_transform(X)

# Train SVM model
svm = SVC(kernel='linear', C=1.0, probability=True)
svm.fit(X_pca, y)

# Load test image and detect facial landmarks
img = cv2.imread('test_face.jpg')
gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
faces = detector(gray)
for face in faces:
    landmarks = predictor(gray, face)

    # Extract features from landmarks
    features = []
    for i in range(68):
        x, y = landmarks.part(i).x, landmarks.part(i).y
        features.append(x)
        features.append(y)

    # Perform PCA on features
    features_pca = pca.transform([features])

    # Predict emotion with SVM model
    prob = svm.predict_proba(features_pca)[0]
    pred_emotion = emotions[np.argmax(prob)]

    # Draw emotion label on image
    x1, y1, x2, y2 = face.left(), face.top(), face.right(), face.bottom()
    cv2.rectangle(img, (x1, y1), (x2, y2), (0, 255, 0), 2, cv2.LINE_AA)
    cv2.putText(img, pred_emotion, (x1, y1 - 10), cv2.FONT_HERSHEY_SIMPLEX, 0.5, (0, 255, 0), 1)

# Display image with emotion label
cv2.imshow('Emotion Recognition', img)
cv2.waitKey(0)
cv2.destroyAllWindows()
```

In this code snippet, we first load the face detector and landmark predictor models from dlib, as well as labeled emotion data in the form of feature vectors (X) and their corresponding emotion labels (y). We then perform principal component analysis (PCA) on the feature data to reduce the dimensionality and train an SVM model using the reduced data.

To recognize emotions in a test image, we detect facial landmarks using the predictor, extract features from the landmarks, and perform PCA on the features. We then predict the emotion using the trained SVM model and draw the emotion label on the image.

This code provides a simple example of how machine learning can be used for emotion recognition using OpenCV.

Conclusion and Additional resources

In this post, we have explored the process of emotion recognition with OpenCV, covering facial landmark detection, feature extraction, and machine learning-based approaches. We have provided code snippets for illustration and links to additional resources for readers to learn more.

Some additional resources for learning about emotion recognition with OpenCV include:

- OpenCV documentation: https://docs.opencv.org/master/d7/d8b/tutorial_py_face_detection.html
- dlib documentation: http://dlib.net/
- Machine Learning Mastery's tutorial on emotion recognition: https://machinelearningmastery.com/emotion-recognition-with-python/
- The EmoPy toolkit for emotion recognition: https://github.com/thoughtworksarts/EmoPy

Overall, emotion recognition is a fascinating and challenging application of computer vision, with many real-world use cases in fields such as healthcare, education, and entertainment. With the tools and techniques provided by OpenCV and other libraries, developers can build sophisticated emotion recognition systems that can benefit individuals and society as a whole.