# clickbank-email-notification-
Instant Notification with clickbank (Email only)
# ClickBank Sales Notification Script

This PHP script is designed to handle ClickBank Instant Notifications for affiliate sales and send email notifications for each new sale. The script decrypts the ClickBank notification using AES-256-CBC encryption and sends an email containing details of the sale, such as order number, date, transaction type, amount, affiliate information, and product details.

## Prerequisites

Before using this script, ensure you have the following:

1. **ClickBank Secret Key:**
   Obtain your ClickBank Secret Key and update the `CB_SECRET_KEY` constant in the script with your actual secret key.

   ```php
   define('CB_SECRET_KEY', 'YOUR_CLICKBANK_SECRET_KEY');
   ```
   you can generate random secret key, **please must read this** : https://support.clickbank.com/hc/en-us/articles/220376507-Instant-Notification-Service-INS?_ga=2.145806644.1451328938.1703542760-2051887488.1703542760&_gl=1*1tm31og*_ga*MjA1MTg4NzQ4OC4xNzAzNTQyNzYw*_ga_Q17BLCFMQX*MTcwMzU0Mjc2MC4xLjEuMTcwMzU0Mzk3MS4wLjAuMA..#Secret%20Key

2. **Email Configuration:**
   You should have a hosting support php > 6.0 (google it)
   Update the `FROM_EMAIL_ADDRESS` and `TO_EMAIL_ADDRESS` constants with the appropriate email addresses. The `FROM_EMAIL_ADDRESS` represents the sender's email address, while `TO_EMAIL_ADDRESS` is the recipient's email address.

   ```php
   define('FROM_EMAIL_ADDRESS', 'your_sender_email@example.com');
   define('TO_EMAIL_ADDRESS', 'your_recipient_email@example.com');
   ```

## Usage

1. Clone or download the script to your server:

   ```bash
   git clone https://github.com/your-username/clickbank-sales-notification.git
   ```

2. Edit the script and set your ClickBank Secret Key and email addresses in the configuration constants.

   ```php
   define('CB_SECRET_KEY', 'YOUR_CLICKBANK_SECRET_KEY');
   define('FROM_EMAIL_ADDRESS', 'your_sender_email@example.com');
   define('TO_EMAIL_ADDRESS', 'your_recipient_email@example.com');
   ```

3. Ensure that your server has the necessary permissions to write log files if you want to use the logging feature.

4. Configure your server's mail system to handle email sending.

5. Set up the script to receive ClickBank Instant Notifications by providing the script's URL in your ClickBank account settings.

6. Test the script by making a test sale to confirm that email notifications are working correctly.

## Logging

The script supports logging of transaction details for both successful and failed transactions. You can enable or disable logging by updating the following constants in the script:

```php
define('LOG_TXT_ERRORS', 'requests-bad.txt');
define('LOG_TXT_GOOD', 'requests-good.txt');
define('LOG_TXT_ALL', 'requests-all.txt');
```

Set the log file names to empty strings to disable logging.

## Important Note

- This script relies on the `mail` function for sending emails. Ensure that your server is properly configured to send emails.

- Review and understand your server's mail configuration and network environment to ensure proper functioning.

- Customize the script based on your specific requirements.

Feel free to reach out if you have any questions or encounter issues.

---

**Author:** Your Name
**License:** MIT License
