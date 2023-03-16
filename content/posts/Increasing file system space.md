+++
title = "Increasing file system space"
date = "2022-11-16"
+++
+++
title = "Increasing file system space"
date = "2022-12-03"
+++
# Increasing File System Space

## Introduction

One of the most common issues faced while working with open-source, machine learning or artificial intelligence technologies is running out of file system storage. It can happen due to a multitude of reasons like the accumulation of data, the code consuming more space, or an unexpected increase in storage requirements. However, this issue can be easily resolved by increasing the file system space. This blog post will provide an overview of how to increase file system space, its significance, and key concepts that will be discussed in this blog.

## Background

An increase in storage space is a useful scenario, and when working with technologies like artificial intelligence or machine learning, it sometimes becomes essential. It allows for storing large datasets and models, which is fundamental to the networks' learning and inference process. An increase in disk space also provides the opportunity of saving backups, reducing the risk of data loss.

## Detailed Steps

Let us consider an example of a Linux environment to increase disk space. The following steps will be helpful :

1. From the Terminal, check the space available in the partition you wish to resize.
```bash
# df -h
```
2. Next, unmount the partition where you need to increase the disk space. This is an essential step. Suppose you have to extend the "/dev/sdb1" directory. In that case, you would use the "umount" command, as shown below.
```bash
# umount /dev/sdb1
```
3. Check the partition again. This step is optional, but verifying that the partition is unmounted is a good practice.
```bash
# df -h
```
4. Resize the partition to the desired size with the "resize2fs" command.
```bash
# resize2fs /dev/sdb1 10G
```
In the above command, we have resized "/dev/sdb1" to 10 GB. You could specify another value, depending on the requirements.

5. Once the resizing completes, you can mount the partition again, which was unmounted in step 2.
```bash
# mount /dev/sdb1
```
6. Check the disk space once again to see if the space was successfully increased.
```bash
# df -h
```

## Commands Required

Following are a few commands required to resolve the issue.

* df -h: Checks the available disk space on a partition.
* umount: Unmounts a partition.
* resize2fs: Resizes a partition.
* mount: Mounts a partition.

## Resources for Further References

The following links are useful resources for further reference:

* [How to resize partitions with the Linux command line and GParted](https://opensource.com/article/18/6/how-resize-partitions-linux)
* [Linux resize2fs command](https://www.computerhope.com/unix/resize2fs.htm)
* [Linux df command](https://www.computerhope.com/unix/udf.htm)

Conclusion

Increasing file system space on machines is one of the most common issues faced in AI or machine learning projects, and it's essential to know how to resolve it. The steps provided above will help increase disk space for any Linux-based system. With increasing storage space, it becomes easy to manage and store datasets for machine learning models, reducing the risks of data loss.