---
title: "Setting up secure remote access with SSH"
date: 2022-09-20
---




Setting up secure remote access with SSH 

SSH (Secure Shell) is a network protocol that enables secure remote access to a device, such as a server or a computer. By setting up SSH, users can securely access their devices and work on them remotely, without having to be physically present at the device's location. This feature is very useful for system administrators, developers, and anybody who needs to access a machine remotely. In this blog post, we'll discuss how to set up secure remote access with SSH.

What is SSH?

As already mentioned, SSH is a network protocol that enables secure remote access to a device. It is based on a client-server architecture, and it uses cryptographic algorithms to ensure that the communication between the client and the server is secure. SSH uses public-key cryptography to authenticate users, and it also encrypts all the data that is transmitted between the client and the server. SSH is widely used in the IT industry, and it is the standard way of remotely accessing a Linux machine.

SSH Server Configuration

To set up SSH server on a Linux machine, we need to install the SSH server package if it is not already installed. Usually, the package is called openssh-server, and it can be installed on most Linux distributions using the package manager. Once the package is installed, we need to configure the SSH server to listen on a specific port, specify the protocol version to use and enable certain authentication methods. 

To customize the SSH server configuration, we need to edit the file /etc/ssh/sshd_config. Some of the options that need to be considered are:

1) Port: Specify the port number on which SSH server listens. Port 22 is the default.

2) Protocol: Specify the SSH protocol version to use. SSH-2 is the recommended protocol version.

3) Authentication methods: Specify which authentication methods to allow, such as password-based authentication, public-key authentication, or both.

4) AllowUsers: Specify the users who are allowed to connect to the SSH server. 

5) PermitRootLogin: Enable or disable root login through SSH.

SSH Client Configuration

To connect to an SSH server, we need to have an SSH client installed on our local machine. Most modern operating systems have an SSH client built-in, such as the Terminal app on Mac OS or the PuTTY application on Windows. To connect to an SSH server, we need to know the server's IP address or hostname and the port number on which the server is listening. 

To connect to an SSH server using the command line, we use the ssh command followed by the username and the IP address or hostname of the server. For example:

ssh username@192.168.1.100

The first time the user connects to an SSH server, the client will prompt the user to accept the server's public key. This is to verify that the user is connecting to the intended server and not to a different one. Once the user accepts the server's public key, the client will add it to the user's known_hosts file, which is a list of public keys of previously connected SSH servers.

SSH Key-Based Authentication

SSH supports key-based authentication, which is more secure than password-based authentication. Key-based authentication uses a public-private key pair to authenticate users. The user generates the key pair, keeps the private key secret, and uploads the public key to the SSH server. When the user connects to the SSH server, the server verifies the user's identity by matching the user's public key to the authorized_keys file on the server. If the public key matches the one in the authorized_keys file, the server allows the user to log in without asking for a password.

To enable key-based authentication, we need to generate a key pair on the client side using the ssh-keygen command. The command generates two key files: the private key and the public key. We then upload the public key to the SSH server's authorized_keys file by copying the contents of the public key file over to the authorized_keys file. Once the public key is added to the authorized_keys file, the user can log in without using a password.

Conclusion

SSH is a powerful and secure tool for remotely accessing devices, allowing users to securely connect to servers or computers from anywhere in the world. However, it is essential to configure SSH properly to ensure it is secure. In this blog post, we discussed how to set up secure remote access with SSH, including how to configure the SSH server, how to connect to an SSH server, and how to use key-based authentication. With these configurations, users can safely and securely access their devices from anywhere in the world.

Additional Resources

- OpenSSH manual: https://man.openbsd.org/OpenBSD-current/man5/sshd_config.5
- SSH key-based authentication: https://www.ssh.com/ssh/key/
- Linuxize: How to set up SSH keys on a Linux server: https://linuxize.com/post/how-to-set-up-ssh-keys-on-ubuntu-20-04/