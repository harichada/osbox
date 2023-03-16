---
title: "Recovering deleted files and data"
date: 2022-09-20
---




Accidentally deleting a file or data can be a frustrating experience, especially when you don't have a backup plan. However, all hope is not lost because there are ways to recover deleted files and data. In this post, we will cover several methods of recovering deleted files and data, ranging from using built-in tools to third-party software.

1. Check the Recycle Bin or Trash Bin
The Recycle Bin or Trash Bin is where deleted files go on Windows or macOS, respectively. If you accidentally deleted a file or data, try checking the Recycle Bin or Trash Bin. If the deleted file is in the Recycle Bin or Trash Bin, click the "Restore" button to recover it. 

2. Restore from a Backup 
If you have a backup plan in place, you can recover deleted files and data from your backup. This method is only useful if you have backed up your files before losing them. You can either use the built-in backup feature in macOS or Windows or use a third-party backup solution. 

3. Use Recovery Software 
If none of the above methods work, recovery software can be an excellent solution. Recovery software is designed to scan your disk or drive for deleted files, allowing you to recover them easily. Some popular recovery software tools include Recuva, Disk Drill, and EaseUS Data Recovery Wizard. 

4. Contact a Professional Data Recovery Service 
In some cases, the data loss may be too severe for recovery software, and a professional data recovery service may be necessary. Data recovery services have specialized equipment and expertise necessary to retrieve lost data in severe cases. It's worth noting that these services can be costly and may not guarantee successful data recovery.

Now that we've covered some methods for recovering deleted files and data, let's look at some code snippets that can help with the recovery process. 

If you are using PowerShell on Windows, you can use the Get-ChildItem command to list all deleted files on your disk. 

```
Get-ChildItem -Path C:\ -Recurse -Force | Where-Object { $_.PSIsContainer -eq $false -and $_.Attributes -match 'Hidden|System|Archive' -and $_.CreationTime -lt (Get-Date).AddDays(-1)}
```

This command will list all deleted files on the C drive that were deleted in the last day. You can then use the Restore-Item command to restore any deleted files you want to recover. 

On macOS, you can use the Terminal to recover deleted files with the following command:

```
sudo /usr/bin/sudo rsync --verbose --human-readable --progress --stats --recursive --times --perms --links --delete "/Volumes/[NAME OF YOUR DISK]/.Trashes/[USER ID]/[PATH TIL FILE]" "/Users/[YOUR USER NAME]/Desktop"
```

This command will restore a deleted file to your Desktop.

In conclusion, deleting files and data can be frustrating, but there are ways to recover them. You can check the Recycle Bin or Trash Bin, restore from a backup, use recovery software, or contact a professional data recovery service. While recovery software and professional data recovery services are not foolproof, they offer the best chance to retrieve lost data. With the code snippets listed above, you can make the recovery process easier and more efficient. 

To learn more about recovering deleted files and data, check out the links below:

- How to Recover Deleted Files on Windows by Recuva 
- How to Recover lost data with Disk Drill
- EaseUS Data Recovery Wizard Guide to Deleted Files Recovery


[Markdown tags: #recovery #deleted #data #software]