# Free phpAnalytics - Web Analytics Software (SaaS)

## Overview

**phpAnalytics** is a self-hosted, privacy-focused web analytics platform designed to provide detailed, real-time traffic reports without compromising user privacy. Built on Laravel and Bootstrap, it offers comprehensive insights into website performance, including visitor behavior, traffic sources, geographic data, and technology usage. With support for subscription-based services, phpAnalytics is ideal for developers, marketers, and businesses looking to build a SaaS analytics solution or monitor their own websites.[https://lunatio.de/phpanalytics/](https://lunatio.de/phpanalytics/)[https://lunatio.de/phpanalytics/](https://lunatio.de/phpanalytics/)

## Features

- **Real-Time Analytics**: Track visitors, pageviews, and events in real-time with a lightweight ~1KB tracking code.[https://lunatio.de/phpanalytics/](https://lunatio.de/phpanalytics/)
- **Detailed Reports**: Analyze:
  - **Overview**: Comprehensive website activity summary.
  - **Acquisitions**: Traffic sources, referrers, search engines, social networks, and campaigns.
  - **Behavior**: Page performance, landing pages, and user interactions.
  - **Geographic**: Visitor locations down to the city level (e.g., Jakarta, Bengaluru, Istanbul).
  - **Technology**: Browsers (e.g., Chrome, Safari), operating systems (e.g., Windows, Android), and screen resolutions.
  - **Events**: Custom event tracking for conversions (e.g., registrations).
- **Privacy Compliance**: GDPR, CCPA, and PECR compliant with no cookies or fingerprinting.
- **Export Options**: Export statistics as CSV for offline analysis.
- **Subscription Plans**: Offer custom plans with monthly/yearly pricing, tax rates, and coupons. Supports payments via PayPal, Stripe, Razorpay, Paystack, Coinbase, Crypto.com, and bank transfers.
- **Admin Panel**: Manage users, websites, payments, plans, tax rates, and coupons through a powerful dashboard.
- **Multi-Language Support**: Includes right-to-left language support and customizable language files.
- **S3 Storage**: Store user-uploaded files using Amazon S3, DigitalOcean Spaces, or Backblaze B2.
- **Customizations**: Add custom CSS/JS in Admin Settings and edit HTML templates in `/resources/views`.
- **Mobile-Friendly**: Responsive design for mobile and high-DPI screens.
- **Third-Party Integrations**: Compatible with tools like Google Analytics for enhanced data analysis.

## Requirements

To run phpAnalytics, ensure your server meets the following requirements:
- PHP 8.x
- MySQL 5.x or 8.x
- Web server (e.g., Apache, Nginx) with the document root set to the `/public` directory
- Cron job support for automated tasks
- SMTP server for email notifications
- (Optional) S3-compatible storage for file uploads

For detailed requirements, refer to the [official documentation](https://lunatio.de/phpanalytics/documentation).

## Installation

1. **Create a MySQL Database**:
   - Create a new MySQL database and assign a user with full privileges.
2. **Upload Files**:
   - Download the phpAnalytics software from here or click [https://lunatio.de/download.php?item=phpanalytics](https://lunatio.de/download.php?item=phpanalytics).
   - Enable hidden file visibility in your file explorer (dotfiles like `.env` may be hidden).
   - Upload the contents of the `Software` folder to your web server’s root (e.g., `public_html` or `example.com`).
   - Set the web server’s document root to the `/public` directory.
3. **Run Installation Wizard**:
   - Navigate to `https://your-domain.com/install` and follow the on-screen instructions to configure the database and initial settings.
4. **Activate License**:
   - Log in to your user account and go to `https://your-domain.com/admin`.
   - Enter your license key to activate the software.
5. **Set Up Cron Job**:
   - In the admin panel, go to **Settings > Cron Job**, copy the provided command, and set up a cron job to run every minute.
6. **Configure Email**:
   - In **Admin > Settings > Email**, set the driver to SMTP and enter your SMTP credentials.
7. **(Optional) Configure Authentication**:
   - For Google/Apple login, configure OAuth settings in **Admin > Settings > Authentication** using Google Cloud Console or Apple Developer account credentials.
8. **(Optional) Configure Storage**:
   - For S3-compatible storage, configure settings in **Admin > Settings > Storage** with your provider’s access keys and endpoint.

For detailed instructions, see the [official documentation](https://lunatio.de/phpanalytics/documentation).

## Updating

To update phpAnalytics to the latest version:
1. Back up your `.env` configuration file.
2. Upload and replace all files with the new `Software` folder contents.
3. Restore the `.env` file.
4. Navigate to `https://your-domain.com/update` and follow the update wizard.

**Note**: Version 32 and above include timezone support for stats, which may reset previous statistics due to a database restructure. Check the [changelog](https://lunatio.de/phpanalytics/changelog) for details.[](https://lunatio.de/phpanalytics/changelog)

## API Usage

phpAnalytics provides a RESTful API to manage reports, websites, and accounts. Example API call to retrieve reports:

```bash
curl --location --request GET 'https://phpanalytics.lunatio.de/api/v1/reports' \
--header 'Accept: application/json' \
--header 'Authorization: Bearer {api_key}'
```

**Note**: The API may not be available in all versions; verify with the [official documentation](https://phpanalytics.lunatio.de/developers).[](https://www.saasworthy.com/product/phpanalytics)

## License

phpAnalytics is a premium software available via a one-time purchase license, providing full source code access and free updates. Choose between:
- **Regular License**: For personal use.
- **Extended License**: For subscription-based SaaS services.

Purchase and licensing details are available at [https://lunatio.de/license](https://lunatio.de/license).

## Support

- **Documentation**: [https://lunatio.de/phpanalytics/documentation](https://lunatio.de/phpanalytics/documentation)[](https://lunatio.de/phpanalytics/documentation)
- **Contact**: Reach out via [Lunatio Support](https://lunatio.de/contact)[](https://lunatio.de/phpanalytics/documentation)

## Contributing

Contributions are welcome! To contribute:
1. Fork the repository.
2. Create a new branch (`git checkout -b feature/your-feature`).
3. Commit your changes (`git commit -m "Add your feature"`).
4. Push to the branch (`git push origin feature/your-feature`).
5. Open a Pull Request.

Please ensure your code adheres to Laravel and Bootstrap coding standards and includes appropriate tests.

## Disclaimer

This README is a community-created guide and not officially affiliated with Lunatio. For official documentation and support, visit [Lunatio](https://lunatio.de/phpanalytics).

---

© 2025 phpAnalytics by [Lunatio](https://lunatio.de). All rights reserved.
