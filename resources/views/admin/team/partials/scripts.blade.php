<script>
    $(function () {
        $("#setting-form").validate({
            rules: {
                company: "required",
            },
        });

        $('.select-options').select2({
            placeholder: "Select a option",
            allowClear: true
        });
    })


    $(function () {
        var TeamManager = {
            init: function() {
                this.cacheDom();
                this.bind();
                this.initPlugin();
            },
            cacheDom: function() {
                this.$teamManager = $('.team-manager');
            },
            bind: function() {
                this.$teamManager.on('click', '.add-a-team-section', this.addNewTeamSection);
                this.$teamManager.on('click', '.add-team', this.addNewTeam);
                this.$teamManager.on('click', '.delete-team', this.removeTeam);
                this.$teamManager.on('click', '.delete-a-team-section', this.removeATeamSection);
            },

            removeTeam: function () {
                var $this, countOfRow;
                $this = $(this);
                countOfRow = $this.parents('.team-tr-manager').find('.team-tr-row').length;
                if (countOfRow > 1) {
                    $this.parents('.team-tr-row').remove();
                }
                return false;
            },

            addNewTeam: function () {
                var $this, $row, $clone;
                $this = $(this);
                $row = $this.parents('td').find('.team-tr-row:first');
                $clone = $row.clone();
                $clone.find(':input').val('');
                $row.after($clone);
                return false;
            },

            removeATeamSection: function () {
                var $this, countOfRow;
                $this = $(this);
                countOfRow = $this.parents('table').find('tbody tr.team-row').length;
                if (countOfRow > 1) {
                    $this.closest('tr').remove();
                }
                return false;
            },

            addNewTeamSection: function () {
                var $this, $row, $clone, $teamTrRow;
                $this = $(this);
                $row = $this.parents('table').find('tbody tr.team-row:last');
                $clone = $row.clone();
                $teamTrRow = $clone.find('.team-tr-row:last');
                if(!$teamTrRow.is(':first-child')){
                    $teamTrRow.remove();
                }

                $clone.find(':input').val('');

                // Adding the same index

                var $indexing = $clone.data('index') + 1;

                $clone.data('index', $indexing);
                $clone.attr('data-index', $indexing);
                $clone.find(':input.team-label').attr('name', 'teams[label][%index%][]'.replace('%index%', $indexing));
                $clone.find(':input.team-name').attr('name', 'teams[name][%index%][]'.replace('%index%', $indexing));

                $this.parents('table').find('tbody tr.team-row:last').after($clone);
                return false;
            },

            initPlugin: function() {
                $('.dropify').dropify()
            }
        };
        TeamManager.init();
    });
</script>
