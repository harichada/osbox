---
title: "Monitoring system performance and resource usage"
date: 2022-09-20
---




Monitoring System Performance and Resource Usage

As systems become increasingly complex, it is crucial to monitor their performance and resource usage to ensure optimal operation. This monitoring process involves tracking critical system metrics and identifying anomalies such as bottlenecks, resource overutilization, or underutilization. In this blog post, we will discuss the importance of monitoring system performance and resource usage, the key metrics to monitor, and techniques for monitoring these metrics.

Why is Monitoring System Performance and Resource Usage Important? 

To keep your system running smoothly and avoid unnecessary downtime, it is essential to continuously monitor its performance and resources. Monitoring helps you quickly identify potential problems, track trends, and enable you to proactively take appropriate measures to prevent or mitigate problems.

In addition, monitoring your system performance and resource usage allows you to optimize your hardware and software resources, which can maximize the efficiency of your system. By leveraging data collected over time, you can identify areas where you may have over-provisioned resources or under-utilized others, which can help you better allocate your resources.

Key Metrics to Monitor

To effectively monitor system performance and resource usage, there are certain key metrics that you should track. These metrics differ depending on the system type and the underlying infrastructure. Let’s take a closer look at some of the essential metrics:

1. CPU Usage: 

Monitoring CPU usage is an important system performance metric to measure. It involves tracking the percentage of time the CPU is in use. High CPU utilization can be an indicator of a system bottleneck, while low utilization can indicate under-utilized resources.

You can measure CPU utilization through various system tools like:

    top - stats of CPU Utilization summary
    sar - longitudinal analysis
    vmstat - overall system information

   Code Snippets: 

    top
    top - 11:26:44 up 61 days,  7:03,  3 users,  load average: 0.00, 0.01, 0.05
    Tasks: 309 total,   2 running, 307 sleeping,   0 stopped,   0 zombie
    %Cpu(s):  0.0 us,  0.0 sy,  0.0 ni,100.0 id,  0.0 wa,  0.0 hi,  0.0 si,  0.0 st
    KiB Mem : 12995628 total,  6462712 free,   443052 used,  6103864 buff/cache
    KiB Swap: 16777212 total, 16629624 free,   147588 used.  1173472 avail Mem 

    vmstat - this command will show the system with overall memory usage, CPU utilization and IO information.
    vmstat 1 5 
    procs -----------memory---------- —swap-- —io--- --system-- ------cpu-----
    r  b     swpd   free     buff  cache  si    so   bi     bo   in   cs  us  sy  io  wa  st
    0  0 166376 22731152 131588 4738692  0   0    0       0       0     0   0    0     0  100  0

2. Memory Usage: 

Monitoring memory usage is also critical for system performance since it identifies whether your system has sufficient memory to execute applications smoothly. You can monitor memory usage through commands such as:

   Code Snippets: 

    free: used to check the overall memory usage
    free -h
                total          used          free        shared  buff/cache   available
    Mem:           3.7G          225M          3.3G           17M          129M          3.2G
    Swap:          2.0G          369M          1.7G 

    top: it can monitor the current running processes with their memory usage
    top - 11:20:40 up 61 days,  7:00,  3 users,  load average: 0.00, 0.01, 0.05
    Tasks: 309 total,   2 running, 307 sleeping,   0 stopped,   0 zombie
    %Cpu(s):  0.0 us,  0.0 sy,  0.0 ni,100.0 id,  0.0 wa,  0.0 hi,  0.0 si,  0.0 st
    KiB Mem : 12997192 total,  6444512 free,   411532 used,  6544148 buff/cache
    KiB Swap: 16777212 total, 16629624 free,   147588 used.  1175304 avail Mem

3. Disk Usage: 

Monitoring disk usage helps in identifying potential disk space allocation problems. You can monitor disk usage by running the following command to list general disk usage details:

   Code Snippet:

    df -h
    Filesystem       Size         Used     Avail     Use%     Mounted on 
    udev             1.9G          0           1.9G      0%        /dev
    tmpfs            389M         11M       378M    3%        /run
    /dev/nvme0n1p2  28G         12G       14G       46%      /
    tmpfs            2.0G          0          2.0G     0%        /dev/shm
    tmpfs            5.0M          0         5.0M     0%        /run/lock
    tmpfs            2.0G          0         2.0G     0%        /sys/fs/cgroup

4. Network Usage: 

Monitoring network usage helps in identifying network bottlenecks, identifying security threats, and identifying user behavior towards the system. You can monitor network usage through commands like:

   Code Snippet:

    netstat: It helps identify the active network connections.
    netstat -atup 

    tcp        0      0 localhost:3306          0.0.0.0:*             LISTEN      1622/mysqld   
    tcp        0      0 10.0.1.15:22            10.0.1.10:49622        ESTABLISHED 613/sshd: abhi [p  ssh]
    tcp6       0      0 [::]:22                 [::]:*                LISTEN      610/sshd        

5. Application Performance: 

It is important to monitor the performance of the underlying applications running in your system. It helps identify memory leaks and performance issues, which can impact system performance. You can monitor application performance using tools like:

   Code Snippets:

    AppDynamics: It helps to identify performance issues in Java, Python, and .NET applications.
    New Relic: This tool collects data about application performance and creates reports, graphs, and dashboards.

Monitoring Techniques

Now that we have gone through the key metrics that need monitoring, let's talk about various techniques used in monitoring systems performance.

1. System Logging: 

System logging provides crucial insights into your system’s behavior over time. By analyzing system log files, administrators gain a deeper understanding of what is happening within the system, detect potential issues, and identify trends.

   Code Snippet:

    Logging in Ubuntu-based system can be done using rsyslogd(server software) and Logrotate(daily rotation of files)

2. Performance Testing: 

Performance testing involves simulating high-stress scenarios in your system to identify bottlenecks and other performance issues. It is an excellent way to identify defects and optimize the system performance.

   Code Snippets:

    Locust: allows developers to define scenarios that simulate user behavior with your system.

3. Load Balancing: 

Load balancing enables higher traffic to be evenly distributed across multiple servers or nodes rapidly.

   Code Snippet:

    NGINX: load-balancing capabilities.

Conclusion

Monitoring system performance and resource usage is critical to ensure the smooth operation of complex systems. The metrics that you monitor, such as CPU usage, memory usage, disk usage, network usage, and application performance, can be key indicators of problems that you may need to solve. By leveraging the appropriate toolsets, you can monitor your system effectively, identify problems early, and take proactive action to keep your system running smoothly. 

Useful Resources: 

1. Linux System Monitoring Basics - https://linode.com/docs/guides/remote-server-monitoring-with-sysdig/
2. Performance testing - https://locust.io/
3. Applicational monitoring - https://www.appdynamics.com/product/server-monitoring/
4. Logging tutorial - https://www.digitalocean.com/community/tutorials/how-to-use-rsyslog-to-send-logs-to-remote-server-on-ubuntu-18-04
5. Load testing using NGIX - https://www.nginx.com/blog/building-a-scalable-web-application-with-nginx-and-node-js/