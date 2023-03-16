import openai
import os
import random
import datetime

openai.api_key = "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"

topics = [
    "Open-source tools for machine learning",
    "AI in natural language processing",
    "Deep learning and its applications",
    "Reinforcement learning for autonomous systems",
    "Ethics in artificial intelligence",
    "Data privacy in machine learning",
    "Big data analytics and AI",
    "Computer vision and image recognition",
    "Generative adversarial networks",
    "AI in healthcare and medical diagnosis",
]
def generate_blog_post(topic, word_limit=2000):
    prompt = f"""
    Please write a well-structured and sophisticated 2000-word blog post on the topic: {topic}. The blog post should be divided into the following sections:

    1. Introduction: Provide an overview of the topic, its significance, and the key concepts that will be discussed in the blog post.
    2. Background: Explain the historical context, the development of the technology, and its evolution over time.
    3. Key Concepts: Describe the core concepts, methods, and techniques related to the topic. Provide examples and use cases to illustrate these concepts.
    4. Applications and Industry Impact: Discuss the real-world applications of the technology and its impact on various industries. Include specific examples and case studies.
    5. Challenges and Limitations: Identify the current challenges and limitations of the technology, as well as potential areas for improvement and research.
    6. Future Outlook: Discuss the future prospects of the technology, potential advancements, and its long-term implications.
    7. Conclusion: Summarize the main points of the blog post and provide a compelling closing statement.
    
    The blog post should be written in an engaging and informative style, and targeted towards a technically-savvy audience with a strong interest in open-source, machine learning, and artificial intelligence technologies.
    Provide the output in Markdown tags where necessary making the file easy to publish in Hugo.
    """

    response = openai.Completion.create(
        engine="text-davinci-002",
        prompt=prompt,
        max_tokens=word_limit,
        n=1,
        stop=None,
        temperature=0.7,
    )

    return response.choices[0].text.strip()


def generate_blog_topics(word_limit=2000):
    prompt = " Please provide me a list of most popular topics on OpenSource Software, Hardware, ML and AI for my blog website"
    response = openai.Completion.create(
        engine="text-davinci-002",
        prompt=prompt,
        max_tokens=word_limit,
        n=5,
        stop=None,
        temperature=0.2,
    )
    print(response)
    content = response.choices[0].text.strip()
    return content


def generate_image_prompts(topic, n=5):
    prompt = f"Generate {n} AI image prompts relevant to a blog post on the topic: {topic}"

    response = openai.Completion.create(
        engine="text-davinci-002",
        prompt=prompt,
        max_tokens=50,
        n=1,
        stop=None,
        temperature=0.7,
    )

    return [p.strip() for p in response.choices[0].text.split("\n") if p.strip()]

def generate_code():
    prompt = f"""
    Write me a code in python, get historical stock data from internet process it and find the bullish and bearish days and predict how it will be today based of the historical data.
    """
    response = openai.Completion.create(
        engine="code-davinci-002",
        prompt=prompt,
        max_tokens=5050,
        n=1,
        stop=None,
        temperature=0,
    )
    print(response)
    content = response.choices[0].text.strip()
    return content

import re

def save_blog_post_to_file(topic, content):
    # Sanitize the topic to use as a file name
    sanitized_topic = re.sub(r'[^\w\s-]', '', topic).strip().lower()
    sanitized_topic = re.sub(r'[-\s]+', '-', sanitized_topic)

    # Create the file name
    file_name = f"{sanitized_topic}.html"

    # Save the content to the file
    with open(file_name, "w", encoding="utf-8") as file:
        file.write(content)

    print(f"Blog post saved to file: {file_name}")


#random_topic = random.choice(topics)
for random_topic in topics:
    generated_blog_post = generate_blog_post(random_topic)
    save_blog_post_to_file(random_topic, generated_blog_post)
    image_prompts = generate_image_prompts(random_topic, generated_blog_post)
    print(random_topic, image_prompts)

#generated_code = generate_blog_topics()
generated_code = generate_code()
save_blog_post_to_file("test1", generated_code)
