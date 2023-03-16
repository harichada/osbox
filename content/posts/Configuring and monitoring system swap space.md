+++
title = "Configuring and monitoring system swap space"
date = "2022-11-16"
+++
+++
title = "Configuring and monitoring system swap space"
date = "2022-12-03"
+++


# Configuring and Monitoring System Swap Space

## Introduction

Swap space is an area on a computer's hard drive that is used as temporary memory when the physical RAM becomes fully utilized. Without enough swap space, a computer may become unresponsive or even crash. Configuring and monitoring system swap space is therefore essential for maintaining stable system performance. In this blog post, we will discuss the various reasons for the cause of the issue or useful scenarios and the steps involved in resolving the issue.

## Background

There are several reasons why a computer may need to use swap space. One common scenario is when the system RAM becomes fully utilized by running applications, and no further memory is available for new applications or processes. When this occurs, the operating system may choose to move inactive memory pages from RAM to the swap space, freeing up physical RAM for use by the active applications. Another reason why swap space may be necessary is when a system experiences memory leaks, where a program continues to allocate memory without releasing it back to the system. In this situation, the swap space can help prevent the system from crashing by providing additional temporary memory.

## Detailed Steps

To check the current swap usage on your system, you can use the `free` command followed by the `-h` option to display values in a human-readable format.

```
$ free -h
```

This command will display the total amount of memory on the system, as well as the amount of memory currently in use and the amount of swap space being used. If the swap space is being used frequently or the amount of swap space available is low, you may need to increase the amount of swap space.

To add more swap space, you can use the `dd` command to create a new swap file.

```
$ sudo dd if=/dev/zero of=/swapfile bs=1G count=4
```

In this example, we are creating a 4GB swap file called `/swapfile`. You can adjust the size of the file as needed based on your system's requirements.

Next, we need to change the permissions on the file so that only the root user can access it.

```
$ sudo chmod 600 /swapfile
```

Once the file permissions have been set, we can format the file as swap space using the `mkswap` command.

```
$ sudo mkswap /swapfile
```

Finally, we can enable the new swap file using the `swapon` command.

```
$ sudo swapon /swapfile
```

To make this change permanent, we need to add an entry to the `/etc/fstab` file.

```
$ sudo nano /etc/fstab
```

Add the following line to the file, replacing `/swapfile` with the path to your own swap file.

```
/swapfile swap swap defaults 0 0
```

## Commands Required

- `free -h`: Displays current system memory usage, including swap space usage.
- `sudo dd if=/dev/zero of=/swapfile bs=1G count=4`: Creates a new 4GB swap file called `/swapfile`.
- `sudo chmod 600 /swapfile`: Sets file permissions on the new swap file.
- `sudo mkswap /swapfile`: Formats the file as swap space.
- `sudo swapon /swapfile`: Enables the new swap file.
- `sudo nano /etc/fstab`: Edits the `/etc/fstab` file to make the swap file permanent.

## Additional Resources

- [How To Add Swap Space on Ubuntu 18.04](https://www.digitalocean.com/community/tutorials/how-to-add-swap-space-on-ubuntu-18-04)
- [What is Swap Space?](https://www.linode.com/docs/guides/swap-space/)