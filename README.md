# Google Scholar Metadata BootComposer / WordPress Plugin

## Description
The **Google Scholar Metadata** plugin enables you to add structured metadata to your WordPress posts for Google Scholar indexing. It provides specific meta fields for posts and automatically outputs the relevant metadata in the header, enhancing the chances of academic content being indexed by Google Scholar.

## Features
- **Custom Metadata Fields**: Adds a meta box to posts with fields for Google Scholar indexing, including title, abstract, authors, journal title, publication date, and more.
- **Multiple Authors Support**: Supports multiple authors with cloneable and sortable fields.
- **Integration with Meta Box Plugin**: Requires the Meta Box plugin for creating custom meta fields.
- **Automated Metadata Output**: Inserts metadata into the `<head>` section of posts to ensure Google Scholar reads and indexes the content correctly.

## Requirements
- WordPress 5.0 or higher
- PHP 7.0 or higher
- [Meta Box Plugin](https://metabox.io/) (installed and activated)

## Installation

1. **Download the Plugin**: Clone or download the plugin files to your WordPress `wp-content/plugins` directory.
2. **Install Required Plugin**: This plugin uses the Meta Box plugin for handling custom fields. It will prompt you to install Meta Box if it’s not already installed.
3. **Activate the Plugin**: Go to your WordPress Admin Dashboard > Plugins and activate the "Google Scholar Metadata" plugin.

## Usage

1. **Add Metadata to a Post**:
   - Open any post in edit mode.
   - Fill in the fields in the "Google Scholar Metadata" meta box for title, abstract, authors, and more.
2. **Metadata Output**:
   - When the post is viewed, the plugin automatically outputs metadata in the `<head>` section based on the values provided.

### Custom Fields Added
- **Title**: The title of the publication.
- **Abstract**: Short abstract of the publication.
- **Authors**: One or more authors (sortable and cloneable).
- **Journal Title**: The name of the journal in which the work was published.
- **PDF URL**: Link to the PDF version of the publication.
- **Issue & Volume**: Issue and volume numbers.
- **Pages**: Start and end pages of the publication.
- **Publication Date**: Date the work was published (formatted as YYYY-MM-DD).

## License
This plugin is licensed under the GPLv2 or later.
