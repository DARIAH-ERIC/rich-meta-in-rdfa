# Rich Meta in RDFa

_Developed by DARIAH for [OpenMethods](https://openmethods.dariah.eu/)_
 
This WordPress plugin allows users to add some Dublin Core data in RDFa within the HTML page of each post. Currently
it is all pretty straightforward because it is only used for harvesting by ISIDORE (https://isidore.science), but in the
future it would be nice to have some tweaks in the admin panel. i.e. Change the namespace and element name of the RDFa
data for a given input like title or excerpt.

---

# Install (via WordPress plugins)
1. Install via [WordPress plugins](https://www.wordpress.org/plugins/rich-meta-in-rdfa)

# Install (manually)
1. Upload directory `rich-meta-in-rdfa` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

# How does it work?

Here is the list of elements being created:
* dc:identifier (the permanent URL of the post)
* dc:title (the title of the post)
* dc:description (the excerpt of the post)
* dc:date (the date the post was created)
* dc:creator (the editor who created the post)
* dc:source (the original source of the post, external link)
* dc:subject (the subject(s) the post is about)
* dc:type (the type of the post, here 'Blog post')
* dc:language (the language of the post)
