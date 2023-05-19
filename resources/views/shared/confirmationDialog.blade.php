<!-- Logout Modal-->
<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalTitleLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalTitleLabel">{{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>{{ $msgLine1 }}</p>
                <p>{{ $msgLine2 }}</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancelar</button>
                <a class="btn btn-primary"
                    onclick="event.preventDefault(); document.getElementById('confirmationModalForm').submit();">{{ $confirmationButton }}</a>
                <form id="confirmationModalForm" action="{{ route($formActionRoute, $formActionRouteParameters) }}"
                    method="POST" style="display: none;">
                    @csrf
                    @method($formMethod)
                </form>
            </div>
        </div>
    </div>
</div>