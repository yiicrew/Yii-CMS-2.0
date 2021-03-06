$(function() {
    $('.add-friend-btn').live('click', function() {
        var $view_item = $(this).parents('table:eq(0)');

        var params = {
            friend_id : $(this).attr('friend_id'),
            return    : 'user_view_item'
        };

        $.post('/social/friend/create', params, function(user_view_item) {
            $view_item.next().remove();
            $view_item.replaceWith(user_view_item);
        });
    });

    $('.confirm-friend-btn').live('click', function() {
        var $view_item = $(this).parents('table:eq(0)');

        var params = {
            friend_id : $(this).attr('friend_id'),
            return    : 'user_view_item'
        };

        $.post('/social/friend/confirm', params, function(user_view_item) {
            $view_item.replaceWith(user_view_item);
        });
    });

    $('.delete-friend-btn').live('click', function() {
        var $btn = $(this);

        var params = {
            friend_id : $(this).attr('friend_id')
        }

        $.post('/social/friend/delete', params, function() {
            $btn.remove();
            showMessage('success', 'Вы больше не друзья')
        });
    });
});