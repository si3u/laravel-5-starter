{{-- confirm modal --}}
<div class="modal fade" id="modal-confirm" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header alert-warning">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">&Ecirc;tes-vous sûr ?</h4>
            </div>
            <div class="modal-body">
                <p></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Non</button>
                <button type="button" class="btn btn-primary btn-submit">Oui</button>
            </div>
        </div>
    </div>
</div>

{{-- notifications --}}
<div class="modal fade" id="modal-notifications" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header alert-info">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Notifications</h4>
            </div>
            <div class="modal-body">
                <table id="tbl-notifications" class="table table-striped table-bordered" width="100%">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Type</th>
                        <th>Lire</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td colspan="3" class="text-center">Il n'y a actuellement aucun avis</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>