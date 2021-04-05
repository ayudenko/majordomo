define(
    [
        'ko',
        'uiComponent',
        'mage/url',
        'mage/storage'
    ],
    function (ko, Component, urlBuilder, storage) {
        'use strict';
        let houseId = 1;
        return Component.extend({
            defaults: {
                template: 'Majordomo_House/house',
            },
            house: ko.observableArray([]),
            getHouse: function () {
                let self = this;
                let serviceUrl = urlBuilder.build('house/house/ajax?houseId=' + houseId);
                return storage.get(
                    serviceUrl,
                    ''
                ).done(
                    function (response) {
                        self.house.push(JSON.parse(response));
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
