$(function () {
    "use strict";
    var seoManager = {
        parentEl: '.seo-manager',
        init: function () {
            this.cacheDom();
            this.bind();
        },
        cacheDom: function () {
            this.$seoManager = $('.seo-manager');
            this.$seoHead = this.$seoManager.find('.seo-manager-head');
            this.$seoBody = this.$seoManager.find('.seo-manager-body');

            /* Input field */
            this.$seoTitleField = this.$seoManager.find('.seo-title-field');
            this.$seoDescField = this.$seoManager.find('.seo-desc-field');
            this.$seoSlugField = this.$seoManager.find('.seo-slug-field');
            this.$title = $('.post-title');
            this.$slug = $('.post-slug');

            /* Placeholder */
            this.$seoTitle = this.$seoManager.find('.seo-title');
            this.$seoDesc = this.$seoManager.find('.seo-desc');
            this.$seoSlug = this.$seoManager.find('.seo-slug');
        },
        bind: function () {
            this.$seoHead.on('click', this.toggleSeoBody.bind(this));
            this.$seoTitleField.on('keyup', this.resolveSeoTitle.bind(this));
            this.$seoDescField.on('keyup', this.resolveSeoDesc.bind(this));
            this.$seoSlugField.on('keyup', this.resolveSeoSlug.bind(this));
            this.$title.on('keyup', this.resolveSlug.bind(this));
        },
        toggleSeoBody: function (e) {
            this.$seoBody.toggle(1000);
        },
        resolveSeoTitle: function (e) {
            this.$seoTitle.text(e.target.value);
            this.$seoSlugField.val(this.generateSlug(e.target.value));
            this.resolveSeoSlug(e);
        },
        resolveSeoDesc: function (e) {
            this.$seoDesc.text(e.target.value);
        },
        resolveSeoSlug: function (e) {
            this.$seoSlug.text(this.generateSlug(e.target.value));
        },
        resolveSlug: function (e) {
            this.$slug.val(this.generateSlug(e.target.value));
        },
        generateSlug: function (slug) {
            return slug.replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '-').toLowerCase();
        }
    };
    seoManager.init();
});

