define(
    [
        'ko',
        'uiComponent',
        'mage/url',
        'mage/storage'
    ],
    function (ko, Component, urlBuilder, storage) {
        'use strict';
        let areaId = 1;
        return Component.extend({
            defaults: {
                template: 'Majordomo_Area/area',
            },
            area: ko.observableArray([]),
            getArea: function () {
                let self = this;
                let serviceUrl = urlBuilder.build('area/area/ajax?areaId=' + areaId);
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
