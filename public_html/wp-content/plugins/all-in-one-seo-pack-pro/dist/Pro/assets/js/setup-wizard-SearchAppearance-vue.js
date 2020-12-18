(window["aioseopjsonp"]=window["aioseopjsonp"]||[]).push([["setup-wizard-SearchAppearance-vue"],{1289:function(t,e,s){},"7bf0":function(t,e,s){"use strict";s.r(e);var a=function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"aioseo-wizard-search-appearance"},[s("wizard-header"),s("wizard-container",[s("wizard-body",{scopedSlots:t._u([{key:"footer",fn:function(){return[s("div",{staticClass:"go-back"},[s("router-link",{staticClass:"no-underline",attrs:{to:t.getPrevLink}},[t._v("←")]),t._v(" "),s("router-link",{attrs:{to:t.getPrevLink}},[t._v(t._s(t.strings.goBack))])],1),s("div",{staticClass:"spacer"}),s("base-button",{attrs:{type:"gray",tag:"router-link",to:t.getNextLink}},[t._v(t._s(t.strings.skipThisStep))]),s("base-button",{attrs:{type:"blue",loading:t.loading},on:{click:t.saveAndContinue}},[t._v(t._s(t.strings.saveAndContinue)+" →")])]},proxy:!0}])},[s("wizard-steps"),s("div",{staticClass:"header"},[t._v(" "+t._s(t.strings.searchAppearance)+" ")]),s("div",{staticClass:"description"},[t._v(" "+t._s(t.strings.description)+" ")]),s("div",{staticClass:"aioseo-settings-row no-border"},[s("div",{staticClass:"settings-name"},[s("div",{staticClass:"name small-margin"},[t._v(" "+t._s(t.strings.googleSnippetPreview)+" ")])]),s("div",{staticClass:"edit-site-info-activator",class:{hover:t.showHoverClass},on:{mouseenter:t.addHoverClass,mouseleave:t.removeHoverClass}},[s("core-google-search-preview",{attrs:{title:t.category.siteTitle,separator:t.options.searchAppearance.global.separator,description:t.category.metaDescription}}),t.showHoverClass&&!t.editing?s("div",{staticClass:"background-fade",on:{click:function(e){t.editing=!0}}}):t._e(),t.showHoverClass&&!t.editing?s("div",{staticClass:"action"},[s("base-button",{attrs:{size:"small",type:"black"},on:{click:function(e){t.editing=!0}}},[t._v(" "+t._s(t.strings.editTitleAndDescription)+" ")])],1):t._e()],1)]),t.editing?s("div",{staticClass:"site-info"},[s("div",{staticClass:"site-title aioseo-settings-row no-border"},[s("div",{staticClass:"settings-name"},[s("div",{staticClass:"name small-margin"},[t._v(t._s(t.strings.siteTitle))])]),s("core-html-tags-editor",{attrs:{"line-numbers":!1,single:"","tags-context":"homePage","default-tags":["site_title","separator_sa","tagline"]},on:{counter:function(e){return t.updateCount(e,"titleCount")}},scopedSlots:t._u([{key:"tags-description",fn:function(){return[t._v(" "+t._s(t.strings.clickToAddSiteTitle)+" ")]},proxy:!0}],null,!1,3952728333),model:{value:t.category.siteTitle,callback:function(e){t.$set(t.category,"siteTitle",e)},expression:"category.siteTitle"}}),s("div",{staticClass:"max-recommended-count",domProps:{innerHTML:t._s(t.maxRecommendedCount(t.titleCount,60))}})],1),s("div",{staticClass:"site-description aioseo-settings-row no-border"},[s("div",{staticClass:"settings-name"},[s("div",{staticClass:"name small-margin"},[t._v(t._s(t.strings.metaDescription))])]),s("core-html-tags-editor",{attrs:{"line-numbers":!1,"tags-context":"homePage","default-tags":["site_title","separator_sa","tagline"]},on:{counter:function(e){return t.updateCount(e,"descriptionCount")}},scopedSlots:t._u([{key:"tags-description",fn:function(){return[t._v(" "+t._s(t.strings.clickToAddSiteDescription)+" ")]},proxy:!0}],null,!1,67309675),model:{value:t.category.metaDescription,callback:function(e){t.$set(t.category,"metaDescription",e)},expression:"category.metaDescription"}}),s("div",{staticClass:"max-recommended-count",domProps:{innerHTML:t._s(t.maxRecommendedCount(t.descriptionCount,160))}})],1)]):t._e(),s("div",{staticClass:"aioseo-settings-row no-border",class:[{"no-margin":t.searchAppearance.underConstruction},{"small-padding":t.searchAppearance.underConstruction}]},[s("div",{staticClass:"settings-name"},[s("div",{staticClass:"name small-margin"},[t._v(" "+t._s(t.strings.isSiteUnderConstruction)+" ")])]),s("base-radio-toggle",{attrs:{name:"underConstruction",options:[{label:t.strings.underConstruction,value:!0,activeClass:"dark"},{label:t.strings.liveSite,value:!1}]},model:{value:t.searchAppearance.underConstruction,callback:function(e){t.$set(t.searchAppearance,"underConstruction",e)},expression:"searchAppearance.underConstruction"}})],1),t.searchAppearance.underConstruction?t._e():s("div",{staticClass:"aioseo-settings-row no-border post-types"},[s("base-toggle",{attrs:{size:"medium"},model:{value:t.searchAppearance.postTypes.postTypes.all,callback:function(e){t.$set(t.searchAppearance.postTypes.postTypes,"all",e)},expression:"searchAppearance.postTypes.postTypes.all"}},[t._v(" "+t._s(t.strings.includeAllPostTypes)+" ")]),t.searchAppearance.postTypes.postTypes.all?t._e():s("core-post-type-options",{attrs:{options:t.searchAppearance.postTypes,type:"postTypes"}})],1),t.searchAppearance.underConstruction?t._e():s("div",{staticClass:"aioseo-settings-row no-border enable-sitemaps"},[s("base-checkbox",{staticClass:"no-clicks",attrs:{round:"",type:"green",value:!0},nativeOn:{click:function(t){t.stopPropagation(),t.preventDefault()}}},[t._v(" "+t._s(t.strings.enableSitemap)+" ")])],1),t.searchAppearance.underConstruction?t._e():s("div",{staticClass:"aioseo-settings-row no-border"},[s("div",{staticClass:"settings-name"},[s("div",{staticClass:"name small-margin"},[t._v(" "+t._s(t.strings.doYouHaveMultipleAuthors)+" ")])]),s("base-radio-toggle",{attrs:{name:"multipleAuthors",options:[{label:t.$constants.GLOBAL_STRINGS.no,value:!1,activeClass:"dark"},{label:t.$constants.GLOBAL_STRINGS.yes,value:!0}]},model:{value:t.searchAppearance.multipleAuthors,callback:function(e){t.$set(t.searchAppearance,"multipleAuthors",e)},expression:"searchAppearance.multipleAuthors"}})],1),t.searchAppearance.underConstruction?t._e():s("div",{staticClass:"aioseo-settings-row no-border no-margin small-padding"},[s("div",{staticClass:"settings-name"},[s("div",{staticClass:"name small-margin"},[t._v(" "+t._s(t.strings.redirectAttachmentPages)+" ")])]),s("base-radio-toggle",{attrs:{name:"redirectAttachmentPages",options:[{label:t.$constants.GLOBAL_STRINGS.no,value:!1,activeClass:"dark"},{label:t.$constants.GLOBAL_STRINGS.yes,value:!0}]},model:{value:t.searchAppearance.redirectAttachmentPages,callback:function(e){t.$set(t.searchAppearance,"redirectAttachmentPages",e)},expression:"searchAppearance.redirectAttachmentPages"}})],1)],1),s("wizard-close-and-exit")],1)],1)},i=[],n=s("5530"),o=s("9c0e"),r=s("2f62"),c={mixins:[o["f"],o["p"]],data:function(){return{loaded:!1,titleCount:0,descriptionCount:0,showHoverClass:!1,editing:!1,loading:!1,stage:"search-appearance",strings:{searchAppearance:this.$t.__("Search Appearance",this.$td),description:this.$t.__("The way your site is displayed in search results is very important. Take some time to look over these settings and tweak as needed.",this.$td),googleSnippetPreview:this.$t.__("Google Snippet Preview",this.$td),editTitleAndDescription:this.$t.__("Edit Title and Description",this.$td),clickToAddSiteTitle:this.$t.__("Click on the tags below to insert variables into your site title.",this.$td),clickToAddSiteDescription:this.$t.__("Click on the tags below to insert variables into your meta description.",this.$td),siteTitle:this.$t.__("Home Page Title",this.$td),metaDescription:this.$t.__("Meta Description",this.$td),isSiteUnderConstruction:this.$t.__("Is the site under construction or live (ready to be indexed)?",this.$td),underConstruction:this.$t.__("Under Construction",this.$td),liveSite:this.$t.__("Live Site",this.$td),includeAllPostTypes:this.$t.__("Include All Post Types",this.$td),enableSitemap:this.$t.__("Enable Sitemap",this.$td),doYouHaveMultipleAuthors:this.$t.__("Do you have multiple authors?",this.$td),redirectAttachmentPages:this.$t.__("Redirect attachment pages?",this.$td)}}},computed:Object(n["a"])(Object(n["a"])({},Object(r["e"])(["options"])),Object(r["e"])("wizard",["category","searchAppearance"])),methods:Object(n["a"])(Object(n["a"])({},Object(r["b"])("wizard",["saveWizard"])),{},{addHoverClass:function(){this.showHoverClass=!0},removeHoverClass:function(){this.showHoverClass=!1},saveAndContinue:function(){var t=this;this.loading=!0,this.saveWizard("searchAppearance").then((function(){t.$router.push(t.getNextLink)}))}}),mounted:function(){this.searchAppearance.redirectAttachmentPages="attachment"===this.options.searchAppearance.dynamic.postTypes.attachment.redirectAttachmentUrls,this.loaded=!0}},l=c,d=(s("ea65"),s("2877")),p=Object(d["a"])(l,a,i,!1,null,null,null);e["default"]=p.exports},ea65:function(t,e,s){"use strict";var a=s("1289"),i=s.n(a);i.a}}]);