---
title: "Automated backups using cron jobs"
date: 2022-09-20
---




Automated Backups Using Cron Jobs

Backing up your data is crucial in ensuring that your crucial files are protected in case of system failures or data breaches. However, manually backing up your files can be time-consuming, repetitive, and prone to errors. Automation can help solve these issues.

Cron is a time-based job scheduler that allows you to schedule repetitive tasks on Linux systems. It is an essential tool for automating critical system maintenance tasks, including backups. In this post, we will explore how to automate backups using cron jobs.

Setting Up the Backup Script

The first step in automating backups is to create a backup script. The backup script is a simple bash script that copies your files to an external storage device, either a physical external hard drive or a cloud-based storage service like AWS S3, Dropbox, or Google Drive. The script can be customized to match your specific backup needs.

Here is an example of a backup script that backs up a specific folder and its contents:

```
#!/bin/bash
BACKUP_DIR=/mnt/backup
SOURCE_DIR=/home/user/myfolder
rsync -av $SOURCE_DIR $BACKUP_DIR
```

In this script, the `$BACKUP_DIR` variable defines the path to the backup destination, while the `$SOURCE_DIR` variable defines the path to the folder being backed up. The `rsync` command copies the contents of the source folder to the backup folder.

Once you have created the backup script, make it executable using the following command:

```
chmod +x backup.sh
```

Scheduling the Backup Job

After creating the backup script, the next step is to schedule the backup job using cron. Cron uses a configuration file, `crontab`, to define scheduled tasks.

To open the `crontab` file, use the following command:

```
crontab -e
```

This command opens the `crontab` file in the default editor. If this is the first time editing the `crontab` file, the editor prompts you to choose your preferred editor.

The `crontab` file has the following format:

```
*   *   *   *   *   command to be executed
-   -   -   -   -
|   |   |   |   |
|   |   |   |   ----- Day of the week (0 - 7) (Sunday is both 0 and 7)
|   |   |   ------- Month (1 - 12)
|   |   --------- Day of the month (1 - 31)
|   ----------- Hour (0 - 23)
------------- Minute (0 - 59)
```

The asterisks and dashes represent time values. For example, to run the backup script every day at 01:00 AM, you can add the following line to the `crontab` file:

```
0 1 * * * /home/user/backup.sh
```

In this example, `0` and `1` represent the minute and hour, respectively, while `* * *` represent the day of the month, month, and day of the week, respectively. The backup script is located in the `/home/user` directory.

Using Cron to Compress and Rotate Old Backups

Over time, backups can take up a lot of storage space. One way to manage this issue is to compress and rotate backups using cron. This process involves compressing old backups into a single file and deleting older backups to free up disk space. Here is an example of a cron job that compresses and rotates backups:

```
15 1 * * * tar -zcvf /mnt/backups/$(date +"%Y-%m-%d").tar.gz /mnt/backups/backups-$(date +"%Y-%m-*").tar.gz --remove-files
```

This cron job compresses backups that were created in the current month and creates a new compressed file with the current date. The `--remove-files` option removes the older backups.

Additional Resources

Cron is a powerful tool that can automate a wide range of system maintenance tasks. To learn more about cron and how to use it effectively, here are some additional resources:

- [Cron Wikipedia page](https://en.wikipedia.org/wiki/Cron)
- [crontab(5) - Linux man page](https://linux.die.net/man/5/crontab)
- [Linux Basics: Schedule Jobs Using Cron](https://www.linux.com/training-tutorials/linux-basics-schedule-jobs-using-cron/)
- [Cron HowTo by Paul Vixie](https://www.paul.sladen.org/cron/)
- [Backing Up Your Linux Server to AWS S3 with `s3cmd` and Cron](https://www.sitepoint.com/backing-up-your-linux-server-to-aws-s3-with-s3cmd-and-cron/)

Conclusion

Automating backups using cron can help ensure that your files are safe and secure. With the help of a backup script and the `crontab` command, you can schedule backups to run automatically, compress and rotate backups, and free up storage space. With these tools, you can take control of your backups and protect your critical data.