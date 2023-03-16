---
title: "GAN(Artificial Intelligence) in action with OpenCV"
date: 2022-09-20
---




In recent years, Generative Adversarial Networks (GANs) have become incredibly popular in the field of Artificial Intelligence (AI) due to their ability to create new data that is similar to the training data. This has many applications, such as image generation or video synthesis, where GANs can generate new images, videos or even entire scenes on their own. One of the powerful tools used to work with GANs is OpenCV, a powerful open-source computer vision library. 

In this blog post, we will explore how GANs can be used in practice with OpenCV. We will start by providing a brief overview of GANs, then dive into how to implement them with Python and OpenCV.

### What are GANs?

Generative Adversarial Networks (GANs) are a type of neural network that consists of two parts: a generator and a discriminator. The generator takes a random noise vector as input and generates a sample similar to the training data. The discriminator, on the other hand, takes in the generated sample and attempts to distinguish it from the real data. During the training, the generator learns to generate samples that are indistinguishable from the real data, while the discriminator learns to distinguish the real data from the generated samples. 

### GANs in Action

There are several ways to use GANs in practice, but one of the most widely used applications is image generation. In this section, we will explore an example of how to use GANs with OpenCV for generating new images.

First, we need to install the necessary libraries. In addition to OpenCV, we will also use the TensorFlow and Keras libraries for our GAN implementation. 

```python
pip install opencv-python
pip install tensorflow
pip install keras
```

Next, we can start by defining our generator and discriminator models. For this example, we will use a simple architecture with a dense layer followed by a reshape layer for the generator and two convolutional layers followed by two dense layers for the discriminator.

```python
from keras import Sequential
from keras.layers import Dense, Reshape, Flatten, Conv2D, Conv2DTranspose
from keras.optimizers import Adam

def build_generator(latent_dim):
    generator = Sequential()
    generator.add(Dense(128 * 7 * 7, input_dim=latent_dim, activation='relu'))
    generator.add(Reshape((7, 7, 128)))
    generator.add(Conv2DTranspose(128, (4,4), strides=(2,2), padding='same', activation='relu'))
    generator.add(Conv2DTranspose(128, (4,4), strides=(2,2), padding='same', activation='relu'))
    generator.add(Conv2D(1, (7,7), activation='sigmoid', padding='same'))
    return generator

def build_discriminator(img_shape):
    discriminator = Sequential()
    discriminator.add(Conv2D(64, (3,3), strides=(2,2), padding='same', input_shape=img_shape, activation='relu'))
    discriminator.add(Conv2D(128, (3,3), strides=(2,2), padding='same', activation='relu'))
    discriminator.add(Flatten())
    discriminator.add(Dense(128, activation='relu'))
    discriminator.add(Dense(1, activation='sigmoid'))
    return discriminator
```

After defining the models, we can initialize and compile them with the following code. 

```python
img_shape = (28,28,1)
latent_dim = 100

# Build the discriminator
discriminator = build_discriminator(img_shape)
discriminator.compile(loss='binary_crossentropy', optimizer=Adam(), metrics=['accuracy'])

# Build the generator
generator = build_generator(latent_dim)

# The generator takes noise as input and generates imgs
z = Input(shape=(latent_dim,))
img = generator(z)

# For the combined model we will only train the generator
discriminator.trainable = False

# The discriminator takes generated images as input and determines validity
valid = discriminator(img)

# The combined model links the generator and discriminator
combined = Model(z, valid)
combined.compile(loss='binary_crossentropy', optimizer=Adam())
```

Now, we can train the GAN with real images taken from the MNIST dataset. 

```python
from keras.datasets import mnist

# Load the dataset
(X_train, _), (_, _) = mnist.load_data()

# Rescale -1 to 1
X_train = X_train / 127.5 - 1.
X_train = np.expand_dims(X_train, axis=3)

# Train the discriminator
valid = np.ones((batch_size, 1))
fake = np.zeros((batch_size, 1))
for epoch in range(epochs):
    # Select a random batch of images
    idx = np.random.randint(0, X_train.shape[0], batch_size)
    imgs = X_train[idx]

    # Generate a batch of new images
    noise = np.random.normal(0, 1, (batch_size, latent_dim))
    gen_imgs = generator.predict(noise)

    # Train the discriminator
    d_loss_real = discriminator.train_on_batch(imgs, valid)
    d_loss_fake = discriminator.train_on_batch(gen_imgs, fake)
    d_loss = 0.5 * np.add(d_loss_real, d_loss_fake)

    # Train the generator
    noise = np.random.normal(0, 1, (batch_size, latent_dim))
    g_loss = combined.train_on_batch(noise, valid)
```

After training the GAN, we can sample from the generator to generate new images. 

```python
# Generate a random noise vector
noise = np.random.normal(0, 1, (1, latent_dim))

# Generate a new image
gen_img = generator.predict(noise)[0]

# Rescale the image from [-1,1] to [0,1]
gen_img = (0.5 * gen_img + 0.5)

# Display the image
cv2.imshow('Generated Image', gen_img)
cv2.waitKey(0)
cv2.destroyAllWindows()
```

### Conclusion

In this blog post, we explored how to use GANs with OpenCV for image generation. We started by providing an overview of GANs and then dove into the implementation details using Python and OpenCV. We explored how to define the generator and discriminator models, how to initialize and compile them, and how to train the GAN. Finally, we generated new images using the trained GAN. 

This is just one example of GANs in action with OpenCV. GANs have many applications, such as video synthesis, and can be used to generate data for a wide range of purposes. If you want to learn more about GANs, you can check out the following resources:

- [The GAN Zoo](https://github.com/hindupuravinash/the-gan-zoo): A collection of GAN implementations in TensorFlow.
- [Generative Deep Learning](https://www.oreilly.com/library/view/generative-deep-learning/9781492041931/): A book on generative modeling with deep learning.
- [GitHub repository for this project](https://github.com/PauliSairanen/python-ai-opencv-gan): The source code for this project. 

We hope this blog post has given you a better understanding of how GANs can be used with OpenCV for image generation. If you have any questions or comments, please feel free to leave them below!