---
title: "Image recognition using convolutional neural networks"
date: 2022-10-15
---


Image recognition using convolutional neural networks (CNN) has revolutionized the field of computer vision, enabling machines to detect and recognize objects in images and videos with unprecedented accuracy. In this blog post, we will explore the basics of CNNs and walk you through the step-by-step process of creating an image recognition system using Python and TensorFlow.
Before we dive into the details, let's understand what convolutional neural networks are and why they are useful in image recognition.
Convolutional Neural Networks
Convolutional Neural Networks (CNNs) are a type of artificial neural network that is particularly well-suited for image recognition tasks. This is because they are designed to process images in a way that mimics how the human visual system works.
At a high level, a CNN consists of multiple layers of interconnected nodes called neurons. Each neuron performs a simple mathematical operation on its input and passes the output to the next layer.
The key to the effectiveness of CNNs lies in the use of "convolutional" layers. These layers apply a set of learnable filters to the input image, essentially searching for specific patterns or features. For example, one filter may look for horizontal lines, while another may be designed to detect edges.
As the input image passes through the layers of the CNN, these filters extract increasingly complex and abstract features from the image. Finally, a fully connected layer maps these features to the output classes, allowing the CNN to classify the image.
Building an Image Recognition System
Now that we've covered the basics of CNNs, let's explore how we can use them to build an image recognition system.
1. Installing TensorFlow
First, we need to install TensorFlow, an open-source machine learning library developed by Google. To install TensorFlow, run the following command in your terminal:
```
pip install tensorflow
```
2. Loading the Dataset
Next, we need to choose a dataset for training and testing our CNN. The most commonly used dataset for image recognition tasks is the CIFAR-10 dataset, which consists of 60,000 32x32 color images in 10 classes.
To load the CIFAR-10 dataset using TensorFlow, run the following code:
``` python
import tensorflow as tf
from tensorflow import keras
(x_train, y_train), (x_test, y_test) = keras.datasets.cifar10.load_data()
```
This code loads the CIFAR-10 dataset into two sets - one for training and one for testing. `x_train` and `x_test` contain the images, while `y_train` and `y_test` contain the corresponding labels.
3. Preprocessing the Images
Before training our CNN, we need to preprocess the images to make them suitable for training. This involves two steps:
- Scaling the pixel values to a range between 0 and 1
- One-hot encoding the labels
Here is the code to preprocess the images:
``` python
x_train = x_train.astype('float32') / 255
x_test = x_test.astype('float32') / 255
y_train = keras.utils.to_categorical(y_train, n_classes)
y_test = keras.utils.to_categorical(y_test, n_classes)
```
4. Building the CNN
Now we are ready to build our CNN. We will use the Keras API, which is a high-level neural networks API written in Python and capable of running on top of TensorFlow.
Our CNN will consist of the following layers:
- Two convolutional layers with 32 filters each, followed by a max pooling layer
- Two convolutional layers with 64 filters each, followed by a max pooling layer
- A fully connected layer with 512 neurons, followed by a dropout layer and an output layer with 10 neurons for the 10 CIFAR-10 classes
``` python
model = keras.Sequential([
    keras.layers.Conv2D(32, (3,3), padding='same', activation='relu', input_shape=x_train.shape[1:]),
    keras.layers.Conv2D(32, (3,3), activation='relu'),
    keras.layers.MaxPooling2D(pool_size=(2,2)),
    keras.layers.Dropout(0.25),
    keras.layers.Conv2D(64, (3,3), padding='same', activation='relu'),
    keras.layers.Conv2D(64, (3,3), activation='relu'),
    keras.layers.MaxPooling2D(pool_size=(2,2)),
    keras.layers.Dropout(0.25),
    keras.layers.Flatten(),
    keras.layers.Dense(512, activation='relu'),
    keras.layers.Dropout(0.5),
    keras.layers.Dense(n_classes, activation='softmax')
])
```
5. Compiling and Training the Model
Next, we need to compile our model by specifying the optimizer, loss function, and evaluation metric. We will use the Adam optimizer, categorical cross-entropy as the loss function and accuracy as the evaluation metric.
``` python
model.compile(optimizer='adam', loss='categorical_crossentropy', metrics=['accuracy'])
```
Finally, we will train the model by calling the `fit()` method on the training data.
``` python
model.fit(x_train, y_train, batch_size=batch_size, epochs=n_epochs, validation_data=(x_test, y_test), shuffle=True)
```
After training, we can evaluate the accuracy of our model on the test set using the `evaluate()` method.
``` python
score = model.evaluate(x_test, y_test, verbose=0)
print('Test accuracy:', score[1])
```
Conclusion
In this blog post, we have explored the basics of convolutional neural networks and demonstrated how to build an image recognition system using Python and TensorFlow. With the increasing availability of open-source hardware and software, anyone can now create innovative projects that leverage the power of AI, ML, and computer vision. We hope that this tutorial has inspired you to start working on your own ML and AI projects.
Complete Python code:
``` python
import tensorflow as tf
from tensorflow import keras
n_classes = 10
batch_size = 128
n_epochs = 15
(x_train, y_train), (x_test, y_test) = keras.datasets.cifar10.load_data()
x_train = x_train.astype('float32') / 255
x_test = x_test.astype('float32') / 255
y_train = keras.utils.to_categorical(y_train, n_classes)
y_test = keras.utils.to_categorical(y_test, n_classes)
model = keras.Sequential([
    keras.layers.Conv2D(32, (3,3), padding='same', activation='relu', input_shape=x_train.shape[1:]),
    keras.layers.Conv2D(32, (3,3), activation='relu'),
    keras.layers.MaxPooling2D(pool_size=(2,2)),
    keras.layers.Dropout(0.25),
    keras.layers.Conv2D(64, (3,3), padding='same', activation='relu'),
    keras.layers.Conv2D(64, (3,3), activation='relu'),
    keras.layers.MaxPooling2D(pool_size=(2,2)),
    keras.layers.Dropout(0.25),
    keras.layers.Flatten(),
    keras.layers.Dense(512, activation='relu'),
    keras.layers.Dropout(0.5),
    keras.layers.Dense(n_classes, activation='softmax')
])
model.compile(optimizer='adam', loss='categorical_crossentropy', metrics=['accuracy'])
model.fit(x_train, y_train, batch_size=batch_size, epochs=n_epochs, validation_data=(x_test, y_test), shuffle=True)
score = model.evaluate(x_test, y_test, verbose=0)
print('Test accuracy:', score[1])
```Image recognition using convolutional neural networks (CNN) has revolutionized the field of computer vision, enabling machines to detect and recognize objects in images and videos with unprecedented accuracy. In this blog post, we will explore the basics of CNNs and walk you through the step-by-step process of creating an image recognition system using Python and TensorFlow.
Before we dive into the details, let's understand what convolutional neural networks are and why they are useful in image recognition.
Convolutional Neural Networks
Convolutional Neural Networks (CNNs) are a type of artificial neural network that is particularly well-suited for image recognition tasks. This is because they are designed to process images in a way that mimics how the human visual system works.
At a high level, a CNN consists of multiple layers of interconnected nodes called neurons. Each neuron performs a simple mathematical operation on its input and passes the output to the next layer.
The key to the effectiveness of CNNs lies in the use of "convolutional" layers. These layers apply a set of learnable filters to the input image, essentially searching for specific patterns or features. For example, one filter may look for horizontal lines, while another may be designed to detect edges.
As the input image passes through the layers of the CNN, these filters extract increasingly complex and abstract features from the image. Finally, a fully connected layer maps these features to the output classes, allowing the CNN to classify the image.
Building an Image Recognition System
Now that we've covered the basics of CNNs, let's explore how we can use them to build an image recognition system.
1. Installing TensorFlow
First, we need to install TensorFlow, an open-source machine learning library developed by Google. To install TensorFlow, run the following command in your terminal:
```
pip install tensorflow
```
2. Loading the Dataset
Next, we need to choose a dataset for training and testing our CNN. The most commonly used dataset for image recognition tasks is the CIFAR-10 dataset, which consists of 60,000 32x32 color images in 10 classes.
To load the CIFAR-10 dataset using TensorFlow, run the following code:
``` python
import tensorflow as tf
from tensorflow import keras
(x_train, y_train), (x_test, y_test) = keras.datasets.cifar10.load_data()
```
This code loads the CIFAR-10 dataset into two sets - one for training and one for testing. `x_train` and `x_test` contain the images, while `y_train` and `y_test` contain the corresponding labels.
3. Preprocessing the Images
Before training our CNN, we need to preprocess the images to make them suitable for training. This involves two steps:
- Scaling the pixel values to a range between 0 and 1
- One-hot encoding the labels
Here is the code to preprocess the images:
``` python
x_train = x_train.astype('float32') / 255
x_test = x_test.astype('float32') / 255
y_train = keras.utils.to_categorical(y_train, n_classes)
y_test = keras.utils.to_categorical(y_test, n_classes)
```
4. Building the CNN
Now we are ready to build our CNN. We will use the Keras API, which is a high-level neural networks API written in Python and capable of running on top of TensorFlow.
Our CNN will consist of the following layers:
- Two convolutional layers with 32 filters each, followed by a max pooling layer
- Two convolutional layers with 64 filters each, followed by a max pooling layer
- A fully connected layer with 512 neurons, followed by a dropout layer and an output layer with 10 neurons for the 10 CIFAR-10 classes
``` python
model = keras.Sequential([
    keras.layers.Conv2D(32, (3,3), padding='same', activation='relu', input_shape=x_train.shape[1:]),
    keras.layers.Conv2D(32, (3,3), activation='relu'),
    keras.layers.MaxPooling2D(pool_size=(2,2)),
    keras.layers.Dropout(0.25),
    keras.layers.Conv2D(64, (3,3), padding='same', activation='relu'),
    keras.layers.Conv2D(64, (3,3), activation='relu'),
    keras.layers.MaxPooling2D(pool_size=(2,2)),
    keras.layers.Dropout(0.25),
    keras.layers.Flatten(),
    keras.layers.Dense(512, activation='relu'),
    keras.layers.Dropout(0.5),
    keras.layers.Dense(n_classes, activation='softmax')
])
```
5. Compiling and Training the Model
Next, we need to compile our model by specifying the optimizer, loss function, and evaluation metric. We will use the Adam optimizer, categorical cross-entropy as the loss function and accuracy as the evaluation metric.
``` python
model.compile(optimizer='adam', loss='categorical_crossentropy', metrics=['accuracy'])
```
Finally, we will train the model by calling the `fit()` method on the training data.
``` python
model.fit(x_train, y_train, batch_size=batch_size, epochs=n_epochs, validation_data=(x_test, y_test), shuffle=True)
```
After training, we can evaluate the accuracy of our model on the test set using the `evaluate()` method.
``` python
score = model.evaluate(x_test, y_test, verbose=0)
print('Test accuracy:', score[1])
```
Conclusion
In this blog post, we have explored the basics of convolutional neural networks and demonstrated how to build an image recognition system using Python and TensorFlow. With the increasing availability of open-source hardware and software, anyone can now create innovative projects that leverage the power of AI, ML, and computer vision. We hope that this tutorial has inspired you to start working on your own ML and AI projects.
Complete Python code:
``` python
import tensorflow as tf
from tensorflow import keras
n_classes = 10
batch_size = 128
n_epochs = 15
(x_train, y_train), (x_test, y_test) = keras.datasets.cifar10.load_data()
x_train = x_train.astype('float32') / 255
x_test = x_test.astype('float32') / 255
y_train = keras.utils.to_categorical(y_train, n_classes)
y_test = keras.utils.to_categorical(y_test, n_classes)
model = keras.Sequential([
    keras.layers.Conv2D(32, (3,3), padding='same', activation='relu', input_shape=x_train.shape[1:]),
    keras.layers.Conv2D(32, (3,3), activation='relu'),
    keras.layers.MaxPooling2D(pool_size=(2,2)),
    keras.layers.Dropout(0.25),
    keras.layers.Conv2D(64, (3,3), padding='same', activation='relu'),
    keras.layers.Conv2D(64, (3,3), activation='relu'),
    keras.layers.MaxPooling2D(pool_size=(2,2)),
    keras.layers.Dropout(0.25),
    keras.layers.Flatten(),
    keras.layers.Dense(512, activation='relu'),
    keras.layers.Dropout(0.5),
    keras.layers.Dense(n_classes, activation='softmax')
])
model.compile(optimizer='adam', loss='categorical_crossentropy', metrics=['accuracy'])
model.fit(x_train, y_train, batch_size=batch_size, epochs=n_epochs, validation_data=(x_test, y_test), shuffle=True)
score = model.evaluate(x_test, y_test, verbose=0)
print('Test accuracy:', score[1])
```Image recognition using convolutional neural networks (CNN) has revolutionized the field of computer vision, enabling machines to detect and recognize objects in images and videos with unprecedented accuracy. In this blog post, we will explore the basics of CNNs and walk you through the step-by-step process of creating an image recognition system using Python and TensorFlow.
Before we dive into the details, let's understand what convolutional neural networks are and why they are useful in image recognition.
Convolutional Neural Networks
Convolutional Neural Networks (CNNs) are a type of artificial neural network that is particularly well-suited for image recognition tasks. This is because they are designed to process images in a way that mimics how the human visual system works.
At a high level, a CNN consists of multiple layers of interconnected nodes called neurons. Each neuron performs a simple mathematical operation on its input and passes the output to the next layer.
The key to the effectiveness of CNNs lies in the use of "convolutional" layers. These layers apply a set of learnable filters to the input image, essentially searching for specific patterns or features. For example, one filter may look for horizontal lines, while another may be designed to detect edges.
As the input image passes through the layers of the CNN, these filters extract increasingly complex and abstract features from the image. Finally, a fully connected layer maps these features to the output classes, allowing the CNN to classify the image.
Building an Image Recognition System
Now that we've covered the basics of CNNs, let's explore how we can use them to build an image recognition system.
1. Installing TensorFlow
First, we need to install TensorFlow, an open-source machine learning library developed by Google. To install TensorFlow, run the following command in your terminal:
```
pip install tensorflow
```
2. Loading the Dataset
Next, we need to choose a dataset for training and testing our CNN. The most commonly used dataset for image recognition tasks is the CIFAR-10 dataset, which consists of 60,000 32x32 color images in 10 classes.
To load the CIFAR-10 dataset using TensorFlow, run the following code:
``` python
import tensorflow as tf
from tensorflow import keras
(x_train, y_train), (x_test, y_test) = keras.datasets.cifar10.load_data()
```
This code loads the CIFAR-10 dataset into two sets - one for training and one for testing. `x_train` and `x_test` contain the images, while `y_train` and `y_test` contain the corresponding labels.
3. Preprocessing the Images
Before training our CNN, we need to preprocess the images to make them suitable for training. This involves two steps:
- Scaling the pixel values to a range between 0 and 1
- One-hot encoding the labels
Here is the code to preprocess the images:
``` python
x_train = x_train.astype('float32') / 255
x_test = x_test.astype('float32') / 255
y_train = keras.utils.to_categorical(y_train, n_classes)
y_test = keras.utils.to_categorical(y_test, n_classes)
```
4. Building the CNN
Now we are ready to build our CNN. We will use the Keras API, which is a high-level neural networks API written in Python and capable of running on top of TensorFlow.
Our CNN will consist of the following layers:
- Two convolutional layers with 32 filters each, followed by a max pooling layer
- Two convolutional layers with 64 filters each, followed by a max pooling layer
- A fully connected layer with 512 neurons, followed by a dropout layer and an output layer with 10 neurons for the 10 CIFAR-10 classes
``` python
model = keras.Sequential([
    keras.layers.Conv2D(32, (3,3), padding='same', activation='relu', input_shape=x_train.shape[1:]),
    keras.layers.Conv2D(32, (3,3), activation='relu'),
    keras.layers.MaxPooling2D(pool_size=(2,2)),
    keras.layers.Dropout(0.25),
    keras.layers.Conv2D(64, (3,3), padding='same', activation='relu'),
    keras.layers.Conv2D(64, (3,3), activation='relu'),
    keras.layers.MaxPooling2D(pool_size=(2,2)),
    keras.layers.Dropout(0.25),
    keras.layers.Flatten(),
    keras.layers.Dense(512, activation='relu'),
    keras.layers.Dropout(0.5),
    keras.layers.Dense(n_classes, activation='softmax')
])
```
5. Compiling and Training the Model
Next, we need to compile our model by specifying the optimizer, loss function, and evaluation metric. We will use the Adam optimizer, categorical cross-entropy as the loss function and accuracy as the evaluation metric.
``` python
model.compile(optimizer='adam', loss='categorical_crossentropy', metrics=['accuracy'])
```
Finally, we will train the model by calling the `fit()` method on the training data.
``` python
model.fit(x_train, y_train, batch_size=batch_size, epochs=n_epochs, validation_data=(x_test, y_test), shuffle=True)
```
After training, we can evaluate the accuracy of our model on the test set using the `evaluate()` method.
``` python
score = model.evaluate(x_test, y_test, verbose=0)
print('Test accuracy:', score[1])
```
Conclusion
In this blog post, we have explored the basics of convolutional neural networks and demonstrated how to build an image recognition system using Python and TensorFlow. With the increasing availability of open-source hardware and software, anyone can now create innovative projects that leverage the power of AI, ML, and computer vision. We hope that this tutorial has inspired you to start working on your own ML and AI projects.
Complete Python code:
``` python
import tensorflow as tf
from tensorflow import keras
n_classes = 10
batch_size = 128
n_epochs = 15
(x_train, y_train), (x_test, y_test) = keras.datasets.cifar10.load_data()
x_train = x_train.astype('float32') / 255
x_test = x_test.astype('float32') / 255
y_train = keras.utils.to_categorical(y_train, n_classes)
y_test = keras.utils.to_categorical(y_test, n_classes)
model = keras.Sequential([
    keras.layers.Conv2D(32, (3,3), padding='same', activation='relu', input_shape=x_train.shape[1:]),
    keras.layers.Conv2D(32, (3,3), activation='relu'),
    keras.layers.MaxPooling2D(pool_size=(2,2)),
    keras.layers.Dropout(0.25),
    keras.layers.Conv2D(64, (3,3), padding='same', activation='relu'),
    keras.layers.Conv2D(64, (3,3), activation='relu'),
    keras.layers.MaxPooling2D(pool_size=(2,2)),
    keras.layers.Dropout(0.25),
    keras.layers.Flatten(),
    keras.layers.Dense(512, activation='relu'),
    keras.layers.Dropout(0.5),
    keras.layers.Dense(n_classes, activation='softmax')
])
model.compile(optimizer='adam', loss='categorical_crossentropy', metrics=['accuracy'])
model.fit(x_train, y_train, batch_size=batch_size, epochs=n_epochs, validation_data=(x_test, y_test), shuffle=True)
score = model.evaluate(x_test, y_test, verbose=0)
print('Test accuracy:', score[1])
```Image recognition using convolutional neural networks (CNN) has revolutionized the field of computer vision, enabling machines to detect and recognize objects in images and videos with unprecedented accuracy. In this blog post, we will explore the basics of CNNs and walk you through the step-by-step process of creating an image recognition system using Python and TensorFlow.
Before we dive into the details, let's understand what convolutional neural networks are and why they are useful in image recognition.
Convolutional Neural Networks
Convolutional Neural Networks (CNNs) are a type of artificial neural network that is particularly well-suited for image recognition tasks. This is because they are designed to process images in a way that mimics how the human visual system works.
At a high level, a CNN consists of multiple layers of interconnected nodes called neurons. Each neuron performs a simple mathematical operation on its input and passes the output to the next layer.
The key to the effectiveness of CNNs lies in the use of "convolutional" layers. These layers apply a set of learnable filters to the input image, essentially searching for specific patterns or features. For example, one filter may look for horizontal lines, while another may be designed to detect edges.
As the input image passes through the layers of the CNN, these filters extract increasingly complex and abstract features from the image. Finally, a fully connected layer maps these features to the output classes, allowing the CNN to classify the image.
Building an Image Recognition System
Now that we've covered the basics of CNNs, let's explore how we can use them to build an image recognition system.
1. Installing TensorFlow
First, we need to install TensorFlow, an open-source machine learning library developed by Google. To install TensorFlow, run the following command in your terminal:
```
pip install tensorflow
```
2. Loading the Dataset
Next, we need to choose a dataset for training and testing our CNN. The most commonly used dataset for image recognition tasks is the CIFAR-10 dataset, which consists of 60,000 32x32 color images in 10 classes.
To load the CIFAR-10 dataset using TensorFlow, run the following code:
``` python
import tensorflow as tf
from tensorflow import keras
(x_train, y_train), (x_test, y_test) = keras.datasets.cifar10.load_data()
```
This code loads the CIFAR-10 dataset into two sets - one for training and one for testing. `x_train` and `x_test` contain the images, while `y_train` and `y_test` contain the corresponding labels.
3. Preprocessing the Images
Before training our CNN, we need to preprocess the images to make them suitable for training. This involves two steps:
- Scaling the pixel values to a range between 0 and 1
- One-hot encoding the labels
Here is the code to preprocess the images:
``` python
x_train = x_train.astype('float32') / 255
x_test = x_test.astype('float32') / 255
y_train = keras.utils.to_categorical(y_train, n_classes)
y_test = keras.utils.to_categorical(y_test, n_classes)
```
4. Building the CNN
Now we are ready to build our CNN. We will use the Keras API, which is a high-level neural networks API written in Python and capable of running on top of TensorFlow.
Our CNN will consist of the following layers:
- Two convolutional layers with 32 filters each, followed by a max pooling layer
- Two convolutional layers with 64 filters each, followed by a max pooling layer
- A fully connected layer with 512 neurons, followed by a dropout layer and an output layer with 10 neurons for the 10 CIFAR-10 classes
``` python
model = keras.Sequential([
    keras.layers.Conv2D(32, (3,3), padding='same', activation='relu', input_shape=x_train.shape[1:]),
    keras.layers.Conv2D(32, (3,3), activation='relu'),
    keras.layers.MaxPooling2D(pool_size=(2,2)),
    keras.layers.Dropout(0.25),
    keras.layers.Conv2D(64, (3,3), padding='same', activation='relu'),
    keras.layers.Conv2D(64, (3,3), activation='relu'),
    keras.layers.MaxPooling2D(pool_size=(2,2)),
    keras.layers.Dropout(0.25),
    keras.layers.Flatten(),
    keras.layers.Dense(512, activation='relu'),
    keras.layers.Dropout(0.5),
    keras.layers.Dense(n_classes, activation='softmax')
])
```
5. Compiling and Training the Model
Next, we need to compile our model by specifying the optimizer, loss function, and evaluation metric. We will use the Adam optimizer, categorical cross-entropy as the loss function and accuracy as the evaluation metric.
``` python
model.compile(optimizer='adam', loss='categorical_crossentropy', metrics=['accuracy'])
```
Finally, we will train the model by calling the `fit()` method on the training data.
``` python
model.fit(x_train, y_train, batch_size=batch_size, epochs=n_epochs, validation_data=(x_test, y_test), shuffle=True)
```
After training, we can evaluate the accuracy of our model on the test set using the `evaluate()` method.
``` python
score = model.evaluate(x_test, y_test, verbose=0)
print('Test accuracy:', score[1])
```
Conclusion
In this blog post, we have explored the basics of convolutional neural networks and demonstrated how to build an image recognition system using Python and TensorFlow. With the increasing availability of open-source hardware and software, anyone can now create innovative projects that leverage the power of AI, ML, and computer vision. We hope that this tutorial has inspired you to start working on your own ML and AI projects.
Complete Python code:
``` python
import tensorflow as tf
from tensorflow import keras
n_classes = 10
batch_size = 128
n_epochs = 15
(x_train, y_train), (x_test, y_test) = keras.datasets.cifar10.load_data()
x_train = x_train.astype('float32') / 255
x_test = x_test.astype('float32') / 255
y_train = keras.utils.to_categorical(y_train, n_classes)
y_test = keras.utils.to_categorical(y_test, n_classes)
model = keras.Sequential([
    keras.layers.Conv2D(32, (3,3), padding='same', activation='relu', input_shape=x_train.shape[1:]),
    keras.layers.Conv2D(32, (3,3), activation='relu'),
    keras.layers.MaxPooling2D(pool_size=(2,2)),
    keras.layers.Dropout(0.25),
    keras.layers.Conv2D(64, (3,3), padding='same', activation='relu'),
    keras.layers.Conv2D(64, (3,3), activation='relu'),
    keras.layers.MaxPooling2D(pool_size=(2,2)),
    keras.layers.Dropout(0.25),
    keras.layers.Flatten(),
    keras.layers.Dense(512, activation='relu'),
    keras.layers.Dropout(0.5),
    keras.layers.Dense(n_classes, activation='softmax')
])
model.compile(optimizer='adam', loss='categorical_crossentropy', metrics=['accuracy'])
model.fit(x_train, y_train, batch_size=batch_size, epochs=n_epochs, validation_data=(x_test, y_test), shuffle=True)
score = model.evaluate(x_test, y_test, verbose=0)
print('Test accuracy:', score[1])
```