---
title: "Dependency Parsing with Spacy"
date: 2022-09-20
---




Dependency Parsing with Spacy

Introduction

Dependency parsing is a crucial concept in natural language processing that involves extracting the relationships between words (tokens) in a sentence. The process involves analyzing the syntactic structure of a sentence, where each token is linked to its corresponding grammatical role, to determine how the words relate to each other. In this post, we'll explore how to perform dependency parsing with Spacy, a popular Python library used for natural language processing tasks.

Installing Spacy

Before we dive into dependency parsing with Spacy, we need to install the Spacy library on our machine. We can use the pip package manager to install Spacy:

```
pip install spacy
```

We also need to download the pre-trained statistical models that are used by Spacy to perform various NLP tasks. We can do this by running the following command in the terminal:

```
python -m spacy download en_core_web_sm
```

Once the installation and download are complete, we're ready to start parsing text!

Parsing Text with Spacy

Let's start by importing Spacy and loading the pre-trained English language model:

```python
import spacy

# Load the pre-trained English language model
nlp = spacy.load('en_core_web_sm')
```

Now let's create a simple sentence:

```python
sentence = "John saw the book on the table"
```

We can parse this sentence using the Spacy nlp object we created earlier:

```python
doc = nlp(sentence)
```

The `doc` object contains a parsed version of the sentence, along with all the associated metadata. We can access individual tokens in the sentence by indexing the `doc` object:

```python
token = doc[0]
print(token.text, token.pos_, token.dep_)
```

This code will print out the first token in the sentence, along with its part of speech (pos) tag and dependency label (dep). The part of speech tag indicates the grammatical category of the token (noun, verb, etc.), while the dependency label indicates the syntactic relationship between the token and its parent in the dependency tree.

Understanding Dependency Labels

Dependency labels can be a bit tricky to understand, so let's take a closer look at some of the most common labels and what they represent:

- `ROOT`: Indicates the root of the dependency tree, which is usually the main verb in the sentence. There can only be one root in a dependency tree.
- `nsubj`: Indicates the nominal subject of the verb. For example, in the sentence "John saw the book," "John" is the nominal subject of the verb "saw."
- `dobj`: Indicates the direct object of the verb. For example, in the sentence "John saw the book," "book" is the direct object of the verb "saw."
- `prep`: Indicates a prepositional modifier. For example, in the sentence "John saw the book on the table," "on" is a preposition that modifies the verb "saw."

These are just a few examples of common dependency labels that you'll encounter when working with Spacy. For a more comprehensive list, you can refer to the Spacy documentation.

Visualizing Dependency Trees

One of the challenges of working with dependency trees is visualizing them in a way that's easy to understand. Fortunately, Spacy provides a built-in method for visualizing dependency trees using the displacy module. Let's take a look at how this works:

```python
from spacy import displacy

# Render the dependency tree for the sentence
displacy.render(doc, style="dep", jupyter=True)
```

This code will display a visualization of the dependency tree for the sentence we parsed earlier. The visualization shows the relationship between each token in the sentence, along with the corresponding labels. Here's what the visualization should look like for our example sentence:

![dependency-tree](https://i.imgur.com/8oRfncD.png)

As you can see, the visualization is color-coded to make it easier to distinguish between different types of tokens and labels. Nouns are shown in blue, verbs in green, and adjectives in orange. Labels are shown in black, with arrowheads indicating the direction of the relationship.

Conclusion

In this post, we've covered the basics of dependency parsing with Spacy. We've learned how to install the Spacy library, load the pre-trained English language model, parse text, and visualize dependency trees. Spacy provides a powerful and easy-to-use interface for working with natural language data, and dependency parsing is an essential concept to master if you want to create sophisticated NLP applications.

Additional Resources

- [Spacy Documentation](https://spacy.io/)
- [Dependency Parsing with Spacy](https://towardsdatascience.com/dependency-parsing-in-nlp-with-spacy-d679a681a6d)
- [Visualizing Spacy's Dependency Parse Trees](https://stackoverflow.com/questions/52561403/visualising-spacys-dependency-parse-trees)