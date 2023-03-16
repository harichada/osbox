---
title: "Increasing file system space"
date: 2022-09-20
---




Increasing file system space is an essential task every system administrator must master. The need for more space can arise due to various reasons, such as running out of memory or storage, or when upgrading the system. In this blog post, we will cover the different strategies and methods to increase file system space.

1. Analyzing the current disk space

Before going ahead and increasing the file system space, you need to ensure that you indeed require it. To do so, you must analyze the current disk space and determine if the usage is over the top. Several tools can carry out this task, such as du and df. For instance, the df command displays the disk space usage of various file systems in Linux. The syntax for using df is as follows:

```
$ df -h
```

This command displays the file system space usage in human-readable format, making it easier to understand.

2. Adding a new physical disk

One of the traditional methods to increase file system space is by adding a new physical disk. This disk could be an internal or external hard drive. Once you've added the disk, you must format it to the desired file system, such as ext4 or NTFS. After formatting, you can then mount the disk to a directory on your system.

```
$ sudo mkfs.ext4 /dev/sdb1
$ sudo mkdir /new_directory
$ sudo mount /dev/sdb1 /new_directory
```

This example shows how to format a new disk (sdb1) using ext4 and mount it to a new directory called "new_directory."

3. Extending a logical volume

If you're using the Logical Volume Manager (LVM), you can extend the available space of a partition. LVM manages the disk space and allows you to allocate or reallocate space as required. The lvextend command can be used to extend the LVM partitions.

```
$ sudo lvextend -L +20G /dev/mapper/vg00-lv_root
```

In this example, lvextend will add 20GB of space to the root directory.

4. Resizing a partition

A partition is a logical division of the disk space, and it's possible to resize one. Before enlarging the partition, you need to ensure that there's unallocated space on the disk that can be used. You can extend or shrink the partition using several tools such as GParted, parted, or fdisk.

The following example demonstrates how to use GParted to resize a partition:

- Install GParted using the following command:

```
$ sudo apt-get install gparted
```

- Open GParted and select the desired partition.

- Right-click on the partition and select "Resize/Move."

- Drag the handles to adjust the partition size.

5. Cleaning up disk space

In some cases, cleaning up unwanted files and programs can help free up disk space. Temporary files, cache, and log files can accumulate over time, taking up precious space that could be used for other purposes. You can use the following commands to clean up the disk space:

```
$ sudo apt-get autoclean
$ sudo apt-get autoremove
```

The autoclean command removes packages that are no longer downloadable, while the autoremove command removes packages that were installed as dependencies but are no longer required. 

Conclusion

Increasing file system space is an integral part of managing any system. This post outlined several methods for increasing file system space, including adding a new physical disk, extending a logical volume, resizing a partition, and cleaning up disk space. By following these methods, you can ensure that you have enough storage space to meet your system's requirements.

Additional resources:
- https://www.tecmint.com/increase-size-of-logical-volume-in-linux/
- https://www.linux.org/docs/man8/lvm-faq.html
- https://www.redhat.com/sysadmin/increase-root-lvm-centos7
- https://www.howtogeek.com/114503/how-to-resize-your-ubuntu-partitions/