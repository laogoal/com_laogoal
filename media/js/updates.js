(function(){
    var Updater = function(containerSelector){
        this.matchObjects = {};
        captureMatches(this, containerSelector);
        runMinutesUpdate(this);
    };

    Updater.prototype = {
        processUpdates: function(data) {
            var that = this;
            Array.each(data, function(dataItem){
                var matchObjects = that.matchObjects[dataItem.id];
                if (null == matchObjects) {
                    return;
                }
                Array.each(matchObjects, function(matchObject){
                    updateMatch(matchObject, dataItem);
                });
            });
        }
    };


    /**
     * @param updater {COM_LAOGOAL_Updater}
     */
    function runMinutesUpdate(updater){
        var update = function(){
            var now = parseInt(new Date().getTime() / 1000);
            Object.each(updater.matchObjects, function(objects){
                Array.each(objects, function(object){
                    var data = object.data;
                    if ('online' == data.status
                            && null != data.current.period
                            && null != data.current.cpsts
                            && ['1T', '2T'].contains(data.current.period)
                    ) {
                        var minute = parseInt((now - data.current.cpsts - tsDiff) / 60);
                        var injuredMinutes = minute - 45;
                        minute = Math.max(Math.min(minute, 45), 1);
                        if ('2T' == data.current.period) {
                            minute += 45;
                        }
                        if (injuredMinutes > 0) {
                            minute += '+';
                        }

                        object.elements.status.each(function(el){
                            el = $(el);
                            if (el.innerText != minute) {
                                el.innerText = minute;
                            }
                        });
                    }
                });
            });
        };
        window.setInterval(update, 22000);
    }

    /**
     *
     * @param updater {COM_LAOGOAL_Updater}
     * @param containerSelector
     */
    function captureMatches(updater, containerSelector) {
        $$(containerSelector + ' .com_laogoal_match_item').each(function(matchContainer){
            matchContainer = $(matchContainer);
            var matchId = matchContainer.getProperty('data-match_id');
            if (null == updater.matchObjects[matchId]) {
                updater.matchObjects[matchId] = [];
            }
            updater.matchObjects[matchId].push({
                elements: {
                    main: matchContainer,
                    score: matchContainer.getElements('.com_laogoal_match_result'),
                    status: matchContainer.getElements('.com_laogoal_match_status')
                },
                data: JSON.decode(matchContainer.getProperty('data-match'))
            });
        });
    }

    function updateMatch(matchElement, dataItem) {
        var matchElementData = matchElement.data;
        if (dataItem.crc && matchElementData.crc == dataItem.crc) {
            return false;
        }
        var mainElement = matchElement.elements.main;

        if (matchElementData.score != dataItem.score) {
            matchElementData.score = dataItem.score;
            matchElement.elements.score.each(function(ele){
                ele = $(ele);
                ele.innerText = dataItem.score[0] + ' - ' + dataItem.score[1];
            });
        }

        if (matchElementData.status != dataItem.status) {
            var statusCSSClass = 'com_laogoal_status_' + matchElementData.status;
            matchElementData.status = dataItem.status;
            if (mainElement.hasClass(statusCSSClass)) {
                mainElement.removeClass(statusCSSClass);
            }
            mainElement.addClass('com_laogoal_status_' + dataItem.status);
            matchElement.elements.status.each(function(ele){
                ele = $(ele);
                if ('online' != dataItem.status) {
                    ele.innerText = Joomla.JText._(dataItem.status);
                }
            });
        }

        if ('online' == dataItem.status && ['1T', '2T', 'ET', 'PS'].contains(dataItem.current.period)) {
            if (!mainElement.hasClass('com_laogoal_status_active')) {
                mainElement.addClass('com_laogoal_status_active');
            }
        } else {
            if (mainElement.hasClass('com_laogoal_status_active')) {
                mainElement.removeClass('com_laogoal_status_active');
            }
        }

        if ('online' == dataItem.status) {
            var onlineStatusLabel = dataItem.current.period;
            if (['1T', '2T'].contains(dataItem.current.period)) {
                if (dataItem.current.minute) {
                    onlineStatusLabel = dataItem.current.minute;
                }
            }

            matchElement.elements.status.each(function(ele){
                ele = $(ele);
                if (ele.innerText != onlineStatusLabel) {
                    ele.innerText = onlineStatusLabel;
                }
            });
        }
        matchElement.data = dataItem;
        return true;
    }

    var tsDiff = 0;
    Updater.createInstance = function(containerSelector, now) {
        var dateObj = new Date();
        tsDiff = parseInt(dateObj.getTime() / 1000) - now;
        return new Updater(containerSelector);
    };

    window.COM_LAOGOAL_Updater = Updater;
})();