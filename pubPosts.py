#!/usr/bin/env python

import os
import sys
import json
import requests
import argparse
import subprocess

def main():
    parser = argparse.ArgumentParser(description='Create posts on hugo and publish it to github repositories.')
    parser.add_argument('-t', '--title', help='Title of the post', required=True)
    parser.add_argument('-c', '--content', help='Content of the post', required=True)
    parser.add_argument('-d', '--date', help='Date of the post', required=True)
    parser.add_argument('-p', '--path', help='Path of the post', required=True)
    parser.add_argument('-g', '--github', help='Github repository name', required=True)
    parser.add_argument('-u', '--username', help='Github username', required=True)
    parser.add_argument('-e', '--email', help='Github email', required=True)
    parser.add_argument('-s', '--slug', help='Slug of the post', required=True)
    args = parser.parse_args()

    # Create post
    create_post(args.title, args.content, args.date, args.path, args.slug)

    # Publish post
    publish_post(args.github, args.username, args.email)
    print(args.username)
def create_post(title, content, date, path, slug):
    # Create post
    post_content = '+++\ntitle = \"' + title + '\"\ndate = \"' + date + '\"\n+++\n' + content
    post_file = open(path + '/' + slug + '.md', 'w')
    post_file.write(post_content)
    post_file.close()

def publish_post(github, username, email):
    # Publish post
    subprocess.call(['git', 'init'])
    subprocess.call(['git', 'add', '.'])
    subprocess.call(['git', 'commit', '-m', '"Initial commit"'])
    subprocess.call(['git', 'remote', 'add', 'origin', 'git@github.com:' + username + '/' + github + '.git'])
    print('git', 'remote', 'add', 'origin', 'git@github.com:' + username + '/' + github + '.git')
    subprocess.call(['git', 'push', '-u', 'origin', 'master'])

if __name__ == '__main__':
    main()