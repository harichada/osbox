---
title: "Configuring and troubleshooting network interface bonding"
date: 2022-09-20
---




Configuring and Troubleshooting Network Interface Bonding: A Comprehensive Guide

Network interface bonding, also known as NIC bonding, is a process of combining multiple physical network interfaces into one logical interface. NIC bonding provides redundancy and improves network performance by increasing bandwidth and network throughput. In this blog post, we will explore the process of configuring and troubleshooting network interface bonding on Linux.

Configuring Network Interface Bonding

NIC bonding configuration involves two primary steps: creating a bond interface and configuring slave interfaces.

1. Creating a Bond Interface

The first step in configuring network interface bonding is to create a bond interface. You can create a bond interface using the ifconfig command. Here's an example:

```
# ifconfig bond0 up
```

This command creates a bond interface named bond0 and brings it up.

Once you have created the bond interface, you need to assign an IP address to it. You can use the ip address command to do that. Here's an example:

```
# ip address add 192.168.10.10/24 dev bond0
```

This command assigns the IP address 192.168.10.10 with a subnet mask 24 to the bond0 interface.

2. Configuring Slave Interfaces

The next step is to configure slave interfaces that will be added to the bond interface. You can use any physical network interface to configure as a slave interface. Here's an example of how you can assign a slave interface to the bond interface:

```
# ifconfig eth0 up
# ifconfig eth1 up
# ifconfig bond0 up
# echo +eth0 > /sys/class/net/bond0/bonding/slaves
# echo +eth1 > /sys/class/net/bond0/bonding/slaves
```

This example assigns eth0 and eth1 interfaces as slave interfaces to bond0.

After configuring slave interfaces, you need to set the mode of the bond interface. There are several modes available, including:

- Round-robin (mode 0)
- Active-backup (mode 1)
- XOR (mode 2)
- Broadcast (mode 3)
- 802.3ad (mode 4)
- Balance-tlb (mode 5)
- Balance-alb (mode 6).

You can set the mode using the following command:

```
# echo 4 > /sys/class/net/bond0/bonding/mode
```

This command sets the 802.3ad mode for the bond interface.

Troubleshooting Network Interface Bonding

Troubleshooting network interface bonding involves identifying and resolving issues that may arise during configuration. In this section, we will explore some common issues that occur during NIC bonding.

1. Interface Not Up

One of the most common issues when configuring NIC bonding is when the bond interface is not up. To check whether the bond interface is up, you can use the ifconfig command. If you don't see the bond interface in the output, it means that the bond interface is not up.

To bring the bond interface up, you can use the following command:

```
# ifconfig bond0 up
```

This command brings the bond interface up.

2. IP Address Not Assigned

Another common issue that occurs during NIC bonding is when the IP address is not assigned to the bond interface. To check whether the IP address is assigned to the bond interface, you can use the ip address command. If you don't see the IP address assigned to the bond interface, it means that the IP address is not assigned.

To assign an IP address to the bond interface, you can use the following command:

```
# ip address add 192.168.10.10/24 dev bond0
```

This command assigns the IP address 192.168.10.10 with a subnet mask 24 to the bond0 interface.

3. Slave Interface Not Up

Another common issue that may arise during NIC bonding is when the slave interface is not up. To check whether a slave interface is up, you can use the ifconfig command. If you don't see the slave interface in the output, it means that the slave interface is not up.

To bring the slave interface up, you can use the following command:

```
# ifconfig eth0 up
```

This command brings the eth0 interface up.

Conclusion

In this blog post, we explored the process of configuring and troubleshooting network interface bonding on Linux. We discussed creating a bond interface, configuring slave interfaces, and setting the mode of the bond interface. We also explored common issues that may arise during NIC bonding and how to troubleshoot them. By following this guide, you should now be able to configure NIC bonding and troubleshoot any issues that may arise.

Additional Resources:

- Linux kernel documentation on bonding: https://www.kernel.org/doc/Documentation/networking/bonding.txt
- Red Hat documentation on configuring network interface bonding on Linux: https://access.redhat.com/documentation/en-us/red_hat_enterprise_linux/7/html/networking_guide/sec-configuring_network_interface_bonding
- A detailed guide to NIC bonding with examples: https://www.tecmint.com/network-bonding-setup-in-debian/
- An article on NIC bonding and network performance: https://www.techrepublic.com/article/how-bonding-multiple-nics-can-improve-network-performance-on-linux-servers/