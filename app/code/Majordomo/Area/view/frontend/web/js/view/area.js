define(
    [
        'ko',
        'uiComponent',
        'mage/url',
        'mage/storage',
    ],
    function (ko, Component, urlBuilder, storage) {
        'use strict';
        let areaId, houseAjaxPath, template;
        return Component.extend({
            initialize: function (config) {
                this._super();
                areaId = config.area_id;
                houseAjaxPath = config.houseAjaxPath;
                template = config.template;
            },
            defaults: {
                template: template,
            },
            area: ko.observableArray([]),
            getArea: function () {
                let self = this;
                if (!Number.isInteger(parseInt(areaId))) {
                    throw 'Wrong areaId value!';
                }
                let serviceUrl = urlBuilder.build(houseAjaxPath + '?areaId=' + areaId);
                return storage.get(
                    serviceUrl,
                    ''
                ).done(
                    function (response) {
                        self.area.push(JSON.parse(response));
                    }
                ).fail(
                    function (response) {
                        alert(response);
                    }
                );
            },
        });
    }
);
