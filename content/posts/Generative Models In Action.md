---
title: "Generative Models In Action"
date: 2022-09-20
---




Generative models are machine learning algorithms that can learn from observed data points to produce new data points that possess similar characteristics to the original dataset. These models generate new data by modeling the distribution of the original dataset, allowing them to create samples that are statistically similar to the original data.

One of the most popular generative models is the Generative Adversarial Networks (GANs). Generative Adversarial Networks (GAN), introduced in 2014 by Ian Goodfellow, is a fascinating concept. GANs have two primary components, the generator network and discriminator network. The generator network takes random noise input and generates synthetic data, while the discriminator network attempts to differentiate between the synthetic data and real data.

GANs improved over previous generative techniques by relying on the idea of game theory to train two neural networks simultaneously, with a generator creating fake samples while a discriminator tries to identify whether each sample is real or fake. The two networks learn from each other until training stops.

Generative models come in handy when dealing with tasks such as data imputation, anomaly detection, captioning, and image synthesis. In this blog post, we will explore two applications of Generative Models, namely:

1. Image Generation

2. Language Generation


### Image Generation

Generative Models can come up with a new image based on input noise in high-dimensional space. Convolutional Neural Networks (CNNs) have been incredibly successful in image classification, with state-of-the-art architectures such as ResNet and DenseNet.

However, one of the biggest problems of generative models is that it is difficult to evaluate their performance. If we assume that we generate a new image from the learned distribution, there is no easy way to verify if the generated image is sensible to a human observer.

We can use [Deep Convolutional Generative Adversarial Networks (DCGAN)](https://github.com/soumik12345/DCGAN_Keras) to generate new images from input noise. Let's create a generator and a discriminator network:


```python

from keras.layers import Input
from keras.layers import Dense, Dropout, Flatten, Conv2D, Conv2DTranspose, Reshape, LeakyReLU, Activation
from keras import layers
from keras import models
from keras.optimizers import Adam
import numpy as np

def discriminator():
    
    input_layer = Input(shape=(28, 28, 1))
    x = Conv2D(64, kernel_size=(3,3), padding="same")(input_layer)
    x = LeakyReLU(alpha=0.2)(x)
    x = Dropout(0.25)(x)
    x = Conv2D(128, kernel_size=(3,3), strides=(2,2), padding="same")(x)
    x = LeakyReLU(alpha=0.2)(x)
    x = Dropout(0.25)(x)
    x = Conv2D(256, kernel_size=(3,3), strides=(2,2), padding="same")(x)
    x = LeakyReLU(alpha=0.2)(x)
    x = Dropout(0.25)(x)
    x = Conv2D(512, kernel_size=(3,3), strides=(2,2), padding="same")(x)
    x = LeakyReLU(alpha=0.2)(x)
    x = Dropout(0.25)(x)
    x = Flatten()(x)
    output_layer = Dense(1, activation='sigmoid')(x)
    
    model = models.Model(inputs=[input_layer], outputs=[output_layer])
    
    return model

def generator():
    
    input_layer = Input(shape=(100,))
    x = Dense(7*7*256)(input_layer)
    x = Activation('relu')(x)
    x = Reshape((7, 7, 256))(x)
    x = Conv2DTranspose(128, kernel_size=(3,3), strides=(2,2), padding="same")(x)
    x = Activation('relu')(x)
    x = Conv2DTranspose(64, kernel_size=(3,3), strides=(2,2), padding="same")(x)
    x = Activation('relu')(x)
    x = Conv2DTranspose(1, kernel_size=(3,3), padding="same")(x)
    output_layer = Activation('tanh')(x)
    
    model = models.Model(inputs=[input_layer], outputs=[output_layer])
    
    return model
```


Here, we created our discriminator and generator network. We will now combine the two and train them using the MNIST dataset. 


```python
import matplotlib.pyplot as plt
from tqdm import tqdm

# load mnist dataset
(X_train, y_train), (_, _) = keras.datasets.mnist.load_data()
X_train = X_train.reshape(-1, 28, 28, 1).astype("float32")

# normalize pixel values
X_train = X_train / 127.5 - 1

# Batch and shuffle data
dataset = tf.data.Dataset.from_tensor_slices(X_train).shuffle(10000).batch(256)

d_optimizer = Adam(learning_rate=0.0002, beta_1=0.5)
g_optimizer = Adam(learning_rate=0.0002, beta_1=0.5)

# training function
@tf.function
def train_step(images):
    
    noise = tf.random.normal([256, 100])
    
    with tf.GradientTape() as gen_tape, tf.GradientTape() as disc_tape:
        generated_images = generator(noise, training=True)
        
        real_output = discriminator(images, training=True)
        fake_output = discriminator(generated_images, training=True)
        
        gen_loss = generator_loss(fake_output)
        disc_loss = discriminator_loss(real_output, fake_output)
        
    gradients_of_generator = gen_tape.gradient(gen_loss, generator.trainable_variables)
    gradients_of_discriminator = disc_tape.gradient(disc_loss, discriminator.trainable_variables)

    g_optimizer.apply_gradients(zip(gradients_of_generator, generator.trainable_variables))
    d_optimizer.apply_gradients(zip(gradients_of_discriminator, discriminator.trainable_variables))
    
    return gen_loss, disc_loss
```

```
def generator_loss(fake_output):
    cross_entropy = tf.keras.losses.BinaryCrossentropy(from_logits=True)
    return cross_entropy(tf.ones_like(fake_output), fake_output)

def discriminator_loss(real_output, fake_output):
    cross_entropy = tf.keras.losses.BinaryCrossentropy(from_logits=True)
    real_loss = cross_entropy(tf.ones_like(real_output), real_output)
    fake_loss = cross_entropy(tf.zeros_like(fake_output), fake_output)
    total_loss = real_loss + fake_loss
    return total_loss
```


Finally, we can train our GAN model using 50 epochs:


```python
num_epochs = 50
for epoch in range(num_epochs):
    for image_batch in tqdm(dataset):
        
        gen_loss, disc_loss = train_step(image_batch)

    if epoch % 5 == 0:
        plt.imshow(generated_images.numpy()[0, :, :, 0], cmap='gray')
        plt.title("Epoch: " + str(epoch))
        plt.show()
```


![image](https://user-images.githubusercontent.com/30522566/138008358-ab2bc0bd-b7aa-41c1-9f82-c81cc152b0f0.png)


### Language Generation

In this section, we will explore how we can generate textual data using LSTM networks. LSTM networks are widely used in natural language processing (NLP) as they are great at capturing long-term dependencies among words.

To generate text using LSTM, we must create a language model. A language model can predict the probability distribution of a given sequence of words. It can predict the probability of the next word given the previous words in the sequence.

Let's build an LSTM model that generates new text based on the input text. 


```python
from keras.layers import Embedding, LSTM, Dense
from keras.models import Sequential
from keras.utils import to_categorical
from keras.preprocessing.sequence import pad_sequences
from keras.preprocessing.text import Tokenizer
import numpy as np

text = open("frankenstein.txt").read()

tokenizer = Tokenizer(char_level=True)
tokenizer.fit_on_texts(text)
num_chars = len(tokenizer.word_index)

sequences = []
for i in range(1, len(text)):
    seq = text[i-1:i+1]
    sequences.append(seq)

sequences = tokenizer.texts_to_sequences(sequences)

X, y = [], []
for i in sequences:
    X.append(i[0])
    y.append(i[1])

X = np.array(X)
y = np.array(y)

X_train = np.reshape(X, (X.shape[0], 1))
y_train = to_categorical(y)

model = Sequential()
model.add(Embedding(num_chars+1, 32, input_length=1))
model.add(LSTM(32))
model.add(Dense(num_chars+1, activation='softmax'))

model.compile(loss='categorical_crossentropy', optimizer='adam', metrics=['accuracy'])

model.fit(X_train, y_train, batch_size=128, epochs=100)
```


With this code, we trained the model for 100 epochs. We can now generate new text using the model. 


```python
# generate sequence of characters
def generate_seq(seed_text, n_chars):
    for i in range(n_chars):
        seq = tokenizer.texts_to_sequences([seed_text])[0][0]
        seq = np.reshape(seq, (1,1))
        result = model.predict_classes(seq, verbose=0)
        out_char = ''
        for char, index in tokenizer.word_index.items():
            if index == result:
                out_char = char
                break
        seed_text += out_char
    return seed_text

# generate 100 new characters
generated_text = generate_seq('Melting, and presently I', 100)
print(generated_text)
```

```
Melting, and presently I left them in frank and with his change in at him.  These if there was so heartless
and a particular excitement, these soothing of the men Weth a little would haviors in as
```


In conclusion, Generative Models are a great success in the Machine Learning world. The two main fields of applications for Generative Models in action are Image generation and Language generation. In this blog post, we developed two Generative Models to generate images and text, respectively. Finally, we can generate an image using a GAN, and we can generate the text with an LSTM network. 

## Additional Links

- [Generative Models for Image Generation](https://blog.floydhub.com/gans-story-so-far/)
- [Generative Models with Keras](https://machinelearningmastery.com/what-are-generative-adversarial-networks-gans/)
- [Generative Models for Language Generation](https://towardsdatascience.com/how-to-build-a-simple-lstm-letter-generator-rnn-82e8e1019a00)
- [Reproducible Research in Python](https://towardsdatascience.com/reproducible-research-in-python-5-ways-to-improve-your-workflow-8e5b6f823d6a)