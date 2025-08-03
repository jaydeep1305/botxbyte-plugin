# Botxbyte WordPress Plugin

**Version:** 1.0.13  
**Author:** Jaydeep Gajera  
**Requires:** WordPress 5.0+  
**License:** GPL-2.0+

A comprehensive WordPress plugin that provides a collection of powerful utilities and AI-powered features for content management, automation, and optimization.

## 🚀 Features

### 🤖 AI-Powered Content Management
- **AI Post Rewriting**: Automatically rewrite existing posts using AI
- **Dynamic Article Publisher**: REST API for automated article creation
- **AI Configuration**: Centralized AI settings management
- **Custom Prompts**: Configure and manage AI prompts

### 📸 Image Optimization
- **Image Converter**: Automatically converts uploaded images to WebP format
- **Maintains original file names and extensions**
- **Improves site performance and loading speeds**

### 📅 Content Scheduling & Automation
- **Draft to Schedule**: Automatically converts draft posts to scheduled posts
- **Configurable timing per day of the week**
- **Author assignment per day**
- **Bulk scheduling capabilities**

### 📱 Social Media Integration
- **Auto Social Posting**: Automatically share posts to social media platforms
- **IFTTT Integration**: Connect with IFTTT for extended automation
- **Customizable social media templates**
- **Post publishing triggers**

### 🔧 Content Enhancement
- **Inline Related Posts**: Display related posts within content
- **Post Date Modification**: Change post publication dates
- **Database String Replacement**: Find and replace text across the database
- **Permalink Management**: Update and manage permalinks

### 📊 Analytics & Monitoring
- **Google Analytics Integration**: GA4 support
- **Google Search Console**: Search performance monitoring
- **Comprehensive logging system**
- **Activity tracking and reporting**

## 📋 Requirements

- **WordPress**: 5.0 or higher
- **PHP**: 7.4 or higher
- **Memory**: 128MB minimum (256MB recommended)
- **Permissions**: `manage_options` capability for admin features

### Dependencies
- `dgoring/dom-query`: ^1.0
- `nlp-tools/nlp-tools`: ^0.1.3 (Natural Language Processing)
- `davmixcool/php-sentiment-analyzer`: ^1.2 (Sentiment Analysis)

## 🛠 Installation

1. **Upload** the plugin files to `/wp-content/plugins/botxbyte/`
2. **Activate** the plugin through the 'Plugins' screen in WordPress
3. **Configure** settings via **Dashboard > Botxbyte**
4. **Set up** your AI configurations and prompts

## 🔌 REST API Endpoints

### Dynamic Article Publisher
```
POST /wp-json/botxbyte/v1/dynamic-article-publish/
```

**Permissions**: Requires `publish_posts` capability

**Request Body Example:**
```json
{
  "post_title": "Your Article Title",
  "content": "Your article content here.",
  "categories": ["Technology", "WordPress"],
  "tags": ["plugin", "automation"],
  "author": {
    "name": "Author Name",
    "email": "author@example.com"
  },
  "featured_media_url": "https://example.com/image.jpg"
}
```

### Additional Endpoints
- `POST /wp-json/botxbyte/v1/article-info/` - Get article information
- `POST /wp-json/botxbyte/v1/article-info-list/` - Get multiple articles info
- `POST /wp-json/botxbyte/v1/permalinks-info/` - Get permalinks information
- `POST /wp-json/botxbyte/v1/update-permalinks/` - Update permalinks

## ⚙️ Configuration

### AI Configuration
1. Navigate to **Botxbyte > AI Configuration**
2. Set up your AI service credentials
3. Configure default settings for content generation

### Image Converter
1. Go to **Botxbyte > Image Converter**
2. Enable WebP conversion
3. Configure quality settings

### Draft Scheduling
1. Access **Botxbyte > Draft to Schedule**
2. Set up timing for each day of the week
3. Configure delay intervals and author assignments

### Social Media Setup
1. Visit **Botxbyte > Social Media**
2. Configure IFTTT webhook URL
3. Set up posting templates

## 🎯 Use Cases

- **Content Agencies**: Automate content publishing workflows
- **Bloggers**: Schedule and optimize content automatically
- **E-commerce**: Product description rewriting and optimization
- **News Sites**: Automated article publishing and social sharing
- **SEO Agencies**: Bulk content optimization and scheduling

## 📝 Logging & Debugging

The plugin includes comprehensive logging:
- **Draft scheduling logs**: Track automated post scheduling
- **Rewrite logs**: Monitor AI post rewriting activities
- **Social media logs**: Track social sharing activities
- **Debug logs**: Located in plugin directory

## 🔒 Security Features

- **Permission checks**: All admin functions require proper capabilities
- **Nonce verification**: CSRF protection on all forms
- **Input sanitization**: All user inputs are properly sanitized
- **Safe file operations**: Secure file handling for image conversion

## 🆘 Support & Documentation

- **Issues**: Report bugs via plugin support forums
- **Feature Requests**: Submit enhancement requests
- **Documentation**: Comprehensive admin interface help

## 📄 License

This plugin is licensed under the GPL-2.0+ license. See LICENSE.txt for details.

## 🏗 Development

### File Structure
```
botxbyte/
├── admin/              # Admin interface and functionality
├── includes/           # Core plugin classes
├── public/             # Public-facing functionality
├── vendor/             # Composer dependencies
├── languages/          # Translation files
└── uninstall.php      # Cleanup on uninstall
```

### Hooks & Filters
The plugin provides various hooks for developers:
- `botxbyte_before_rewrite_post`
- `botxbyte_after_schedule_post`
- `botxbyte_social_media_post`

## 🔄 Changelog

### Version 1.0.13
- Enhanced AI integration
- Improved image conversion performance
- Bug fixes and security improvements

---

**Developed by Jaydeep Gajera** | [Website](https://www.botxbyte.com) | [Facebook](https://fb.com/jaydeep.gajera)