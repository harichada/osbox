---
title: "Using LVM for disk management and expansion"
date: 2022-09-20
---




Introduction

Logical Volume Management (LVM) is a method of disk management and expansion that allows for the creation of logical volumes (LVs) from physical volumes (PVs) to provide flexible and dynamic disk space management. It is used on systems that have a need for increased storage capacity, such as a server or a workstation. In this post, we will discuss how to use LVM for disk management and expansion.

Creating Physical Volumes

Before we can use LVM, we need to create physical volumes. A physical volume can be created on a block device such as a partition, a whole disk, or even a RAID array. In this example, let us assume we have a spare, unused SSD drive connected to our system as /dev/sdb.

We can initialize the disk, create a partition table, and add a partition to it using fdisk as shown below:

$ sudo fdisk /dev/sdb
Command (m for help): n
Partition type:
   p   primary (0 primary, 0 extended, 4 free)
   e   extended
Select (default p): p
Partition number (1-4, default 1): 1
First sector (2048-1048575, default 2048):
Last sector, +sectors or +size{K,M,G,T,P} (2048-1048575, default 1048575):
Created a new partition 1 of type 'Linux' and of size 511 MiB.

We can now create a physical volume on the new partition by running:

$ sudo pvcreate /dev/sdb1
  Physical volume "/dev/sdb1" successfully created.

Creating Volume Groups

After creating physical volumes, we will group them into logical units known as volume groups (VGs). A volume group is a pool of physical volumes that can be used to create logical volumes. For example, we can create a volume group called myvg that contains our newly created physical volume /dev/sdb1:

$ sudo vgcreate myvg /dev/sdb1
  Volume group "myvg" successfully created

Creating Logical Volumes

Now that we have a volume group, we can create logical volumes to store data. A logical volume is similar to a traditional partition but is much more flexible since it can be resized dynamically without the need to unmount the filesystem. For example, we can create a logical volume called mylv that consumes 80% of the free space in the volume group:

$ sudo lvcreate -l 80%FREE -n mylv myvg
  Logical volume "mylv" created.

Next, we need to create a filesystem on the logical volume to contain data. We can choose any filesystem we want, but in this example, we'll use ext4:

$ sudo mkfs.ext4 /dev/myvg/mylv
  mke2fs 1.45.5 (07-Jan-2020)
  Creating filesystem with 196608 4k blocks and 49152 inodes
  Filesystem UUID: fbef0e7c-4960-4f7e-b838-ecda9407b443
  Superblock backups stored on blocks:
    32768, 98304, 163840

Finally, we can mount the logical volume to a directory so that we can access and store data on it:

$ sudo mkdir /mnt/mylv
$ sudo mount /dev/myvg/mylv /mnt/mylv

Expanding Logical Volumes

One of the best features of LVM is the ability to expand logical volumes even while they're in use. We can expand the logical volume we created earlier by running:

$ sudo lvresize -L +10G /dev/myvg/mylv
  Size of logical volume myvg/mylv changed from <X> GiB (<n> extents) to <X+10> GiB (<n+2560> extents).
  Logical volume mylv successfully resized.

We can confirm that the change was successful by running:

$ sudo lvdisplay /dev/myvg/mylv
  --- Logical volume ---
  LV Path                /dev/myvg/mylv
  LV Name                mylv
  VG Name                myvg
  LV UUID                0z91UE-XjqJ-oNc1-w0si-CSPc-x0iu-xOqtW8
  LV Write Access        read/write
  LV Creation host, time localhost, 2022-03-01 21:09:42 +00:00
  LV Status              available
  # open                 1
  LV Size                30.00 GiB
  Current LE             7680
  Segments               2
  Allocation             inherit
  Read ahead sectors     auto
  - currently set to     256
  Block device           253:0

Here, we can see that our logical volume has been increased in size to 30GB.

Conclusion

Using LVM for disk management and expansion offers great flexibility and enables us to dynamically manage disk space on our systems. We can easily create physical volumes, volume groups, and logical volumes, and expand logical volumes without any downtime. In this post, we have gone through the steps of creating physical volumes, volume groups, logical volumes, and expanding logical volumes. 

Additional Resources

For more information about LVM, here are some useful resources:

- LVM Administrator's Guide: https://tldp.org/HOWTO/LVM-HOWTO/
- Red Hat Enterprise Linux System Administrator's Guide: https://access.redhat.com/documentation/en-us/red_hat_enterprise_linux/7/html/logical_volume_manager_administration/
- Linux LVM: An Introduction: https://www.linux.com/training-tutorials/linux-lvm-introduction/
- LVM Man Pages: https://manpages.debian.org/stretch/lvm2/index.html

