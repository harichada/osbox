---
title: "Configuring and monitoring system swap space"
date: 2022-09-20
---




Configuring and Monitoring System Swap Space

Understanding Swap Space

Swap space is an essential component of modern computing systems. It is a designated portion of the hard drive that is used when the system requires additional memory beyond the available RAM. When a system runs out of RAM, it moves some data from RAM to swap space to free up RAM. This data is not actively being used, and therefore, swapping it out of RAM does not affect the performance of the system.

The amount of swap space required depends on the workload and the available RAM. In general, the amount of swap space should be at least equal to the amount of RAM available. If the system runs out of swap space, it could crash, and data loss could occur.

In this article, we will discuss how to configure swap space and monitor its usage to ensure optimal system performance.

Configuring Swap Space

The following is a step-by-step guide to configuring swap space on your Linux system.

Step 1: Check if Swap Space Exists

Before creating swap space, it is important to verify if swap space already exists on your system. To do so, execute the following command in the terminal:

```
sudo swapon --show
```

If this command does not return any output, there is no active swap space on the system.

Step 2: Create a Swap File

To create a swap file, execute the following command:

```
sudo fallocate -l [SIZE] /swapfile
```

Replace [SIZE] with the desired size of the swap file. For example, if you want to create a 2GB swap file, you would use the following command:

```
sudo fallocate -l 2G /swapfile
```

Step 3: Format Swap File

Execute the following command to format the swap file:

```
sudo mkswap /swapfile
```

Step 4: Activate Swap File

Execute the following command to activate the swap file:

```
sudo swapon /swapfile
```

Step 5: Verify Swap Space

Execute the following command to verify the existence of the new swap space:

```
sudo swapon --show
```

The system should now be using the newly created swap space.

Monitoring Swap Space

Monitoring swap space is essential to ensure optimal system performance. In this section, we will discuss how to monitor swap space usage using various tools.

1. Top

Top is a Linux utility that provides real-time information on system processes and resource usage. To view swap space usage using Top, execute the following command in the terminal:

```
top -o %MEM
```

This command will display the processes consuming the most memory, including swap space usage.

2. vmstat

The vmstat utility displays various statistics pertaining to system memory, including swap space usage. To view swap space usage using vmstat, execute the following command:

```
vmstat -s
```

This command will produce output similar to the following:

```
        2097151 K total swap space
              0 K used swap space
        2097151 K free swap space
        4294967295 non-nice user cpu ticks
```

This output shows that there is 2GB (2097151 K) of total swap space, with 0 KB used and 2GB free.

3. sar

The sar utility is used for system resource monitoring and reporting. To view swap space usage using sar, execute the following command:

```
sudo sar -S -s [START TIME] -e [END TIME]
```

Replace [START TIME] and [END TIME] with the start and end times of the monitoring period. For example, to monitor swap space usage from 12:00 PM to 1:00 PM on July 1st, you would use the following command:

```
sudo sar -S -s 12:00:00 -e 13:00:00 01
```

This command will produce output similar to the following:

```
Linux 5.11.0-25-generic (hostname) 	07/01/2022 	_x86_64_	(4 CPU)

12:00:01 PM swpall  swpcadswp  swpocc
12:10:01 PM       0         0         0
12:20:01 PM       0         0         0
12:30:01 PM       0         0         0
12:40:01 PM       0         0         0
12:50:01 PM       0         0         0
```

This output shows that there is no swap space usage during the monitoring period.

Conclusion

Configuring and monitoring swap space is essential to ensure optimal system performance. In this article, we discussed how to configure swap space on a Linux system and monitor its usage using various tools. By following these best practices, you can ensure that your system is using swap space efficiently and prevent system crashes or data loss.

Additional Resources:

- Red Hat Blog: Understanding Swap Space in Linux: https://www.redhat.com/en/blog/understanding-swap-space-linux
- Linuxize: How to Add Swap Space on Ubuntu 20.04: https://linuxize.com/post/how-to-add-swap-space-on-ubuntu-20-04/
- Linux Journal: Understanding Linux Virtual Memory and Swap Space: https://www.linuxjournal.com/content/understanding-linux-virtual-memory-and-swap-space