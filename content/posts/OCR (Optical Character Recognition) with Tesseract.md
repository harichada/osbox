---
title: "OCR (Optical Character Recognition) with Tesseract"
date: 2022-09-20
---




OCR (Optical Character Recognition) with Tesseract: Understanding the Concept

OCR (Optical Character Recognition) is an important technology that enables the recognition of printed or handwritten text characters from an image (JPG, PNG, TIFF, PDF, etc.) or a scanned document. It is an efficient way of digitizing physical text documents and converting them into machine-readable text format. Tesseract is an open-source OCR engine that has been widely used for optical character recognition. In this blog post, we will explore how to use Tesseract for OCR and the relevant concepts associated with it.

1. Installing Tesseract with Python
Before we dive into the use of Tesseract, let's quickly go over how to install Tesseract with Python. 
```
!pip install pytesseract
```
Now that we have installed pytesseract, we can now use Tesseract for OCR.

2. Using Tesseract for OCR
Tesseract provides a simple way of performing OCR on an image or scanned document. The following example shows how to use Tesseract to extract text from an image in Python.

```
import pytesseract
from PIL import Image

img = Image.open('example.jpg')

text = pytesseract.image_to_string(img, lang='eng')
```

The `image_to_string` function is the main method of Tesseract that performs OCR on the image provided as input. This method accepts an image in PIL format and the language parameter for language customization.

3. Language Customization with Tesseract
The `language` parameter in the `image_to_string` method is used to specify the language of the text. If the language is not specified, Tesseract will use its default language, which is English. To use a specific language, we need to download the language pack for that language.

```
!sudo apt-get install tesseract-ocr
!sudo apt-get install libtesseract-dev

import requests
from bs4 import BeautifulSoup

url = "https://github.com/tesseract-ocr/tessdata"
response = requests.get(url)
soup = BeautifulSoup(response.content, 'html.parser')

languages = []

for a in soup.find_all('a', href=True):
    if '.traineddata' in a.get('href'):
        language = a.get('href').replace('/', '')
        languages.append(language)

print(languages)
```

This code snippet downloads the available language packs for Tesseract from the official GitHub repository. Once you've downloaded the language pack you want, place it in the Tesseract's `tessdata` directory.

4. Tesseract Configuration Options
Tesseract provides a number of configuration options that can be used to customize OCR results. Here are some of the options:

- `--psm N`: It is used to set page segmentation mode, where N is an integer that specifies the mode. The page segmentation mode determines how Tesseract recognizes text regions on the page. 

- `--oem N`: It is used to set OCR engine mode, where N is an integer that specifies the mode. The OCR engine mode determines how Tesseract recognizes text.

- `-c key=value`: It is used to set a custom configuration variable. The `-c` parameter is followed by the key and value separated by an equals sign.

Here is an example of using configuration options with Tesseract in Python.

```
config = '--psm 6'

img = Image.open('example.jpg')
text = pytesseract.image_to_string(img, lang='eng', config=config)
```

This snippet shows how to use the `--psm` configuration option with Tesseract to set the page segmentation mode to `6`.

5. Conclusion
In this blog post, we have discussed the concept and practical implementation of using Tesseract for OCR in Python. We have also covered language customization and Tesseract configuration options to further enhance the OCR results.

Links to Additional Resources:
- The official Tesseract GitHub repository: https://github.com/tesseract-ocr/tesseract
- Official documentation for the Tesseract OCR engine: https://tesseract-ocr.github.io/tessdoc/Home.html
- An overview of OCR with Tesseract: https://nanonets.com/blog/ocr-with-tesseract/