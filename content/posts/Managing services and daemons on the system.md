---
title: "Managing services and daemons on the system"
date: 2022-09-20
---




Managing services and daemons on the system is a crucial aspect of system administration. Services and daemons are programs or background processes that run on a system continuously or on demand to perform specific tasks or functions. Examples of services include web servers, database servers, email servers, and file servers, while examples of daemons include syslogd, xinetd, and samba. In this blog post, we will discuss the different methods used to manage services and daemons on a Linux system.

1. Service Management utilities

One of the most popular ways of managing services and daemons on a Linux system is by using the Service Management utilities. These utilities provide a simple and standardized interface for starting, stopping, restarting, and checking the status of services on a system. They are typically installed by default on most Linux distributions.

Systemd is the default init system used by many modern Linux distributions, and it provides the systemctl command-line utility for managing services. For example, to start the Apache HTTP server, you can run the command:

```
sudo systemctl start apache2
```

To stop the service, you can run:

```
sudo systemctl stop apache2
```

To check the status of the service, you can run:

```
sudo systemctl status apache2
```

You can also use systemctl to enable or disable a service, which determines whether it is automatically started or stopped at boot time:

```
sudo systemctl enable apache2
sudo systemctl disable apache2
```

Other Service Management utilities include init, Upstart, and SysV init, which provide similar functionality.

2. Configuration files

Another way of managing services and daemons on a Linux system is by using configuration files. These files typically contain settings and parameters that are used by the service or daemon to perform its functions. By modifying these files, you can change the behavior and settings of a service or daemon.

The location and format of the configuration files varies depending on the service or daemon in question. For example, the Apache HTTP server configuration file is typically located at /etc/httpd/httpd.conf on Red Hat-based distributions, and /etc/apache2/apache2.conf on Debian-based distributions.

Here's an example of how you can modify the Apache HTTP server configuration file to change the default port from 80 to 8080:

```
sudo nano /etc/httpd/httpd.conf
```

Find the line that says "Listen 80" and change it to "Listen 8080". Save and exit the file. Then, restart the Apache HTTP server for the changes to take effect:

```
sudo systemctl restart apache2
```

3. Systemd Units

Systemd Units are files that describe a unit of work that systemd should manage. Services and daemons are typically defined as systemd units. These units include configuration settings that describe how the service or daemon should run, such as the program to execute, any command-line arguments, and environment variables.

Systemd Units are typically stored in the /etc/systemd/system directory or the /usr/lib/systemd/system directory on most Linux distributions. To manage a systemd unit, you can use the systemctl command-line utility.

Here's an example of how you can create a systemd unit file to start a custom service:

```
sudo nano /etc/systemd/system/custom.service
```

Paste the following content into the file:

```
[Unit]
Description=Custom Service
After=network.target

[Service]
ExecStart=/usr/bin/custom-service
Restart=always

[Install]
WantedBy=multi-user.target
```

The [Unit] section contains metadata about the unit, while the [Service] section contains information about the service or daemon to run. Once saved, reload the systemd daemon for the changes to take effect:

```
sudo systemctl daemon-reload
```

Then, start the custom service and check its status:

```
sudo systemctl start custom
sudo systemctl status custom
```

The above commands will start the custom service and display its status. You can now stop, restart, or modify the custom service as needed.

Conclusion

Managing services and daemons on a Linux system is an essential task for system administrators. In this blog post, we discussed three different methods for managing services and daemons on a Linux system. These included using Service Management utilities, modifying configuration files, and working with systemd units. By understanding these methods, system administrators can efficiently manage services and daemons on Linux systems, ensuring the smooth operation of critical system components.

Additional Resources:

- The Linux Documentation Project: Systemd
- Red Hat System Administrator's Guide: Managing Services
- Ubuntu Wiki: SystemdBrowsable=yes