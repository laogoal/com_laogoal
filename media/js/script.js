window.addEvent('domready', function() {
    $$('.com_laogoal_match_item .com_laogoal_match_item_link').each(function(el){
        el = $(el);
        el.addEvent('click', function(event){
            event.stop();
            event.stopPropagation();
            el.setProperty('target', 'matchwnd');
            var uri = new URI(el.getProperty('href'));
            var params = uri.getData();
            params['tmpl'] = 'component';
            uri.setData(params);
            window.open(uri.toRelative(), 'matchwnd', 'width=600px, height=500px');
            return false;
        });
    });
});