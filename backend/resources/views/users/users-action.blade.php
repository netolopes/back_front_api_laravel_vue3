<a href="javascript:void(0)" data-toggle="tooltip" onClick="editFunc({{ $id }})" data-original-title="Edit" class="edit btn btn-success edit">
    Edit
    </a>
    <a href="javascript:void(0);" id="delete-compnay" onClick="deleteFunc({{ $id }})" data-toggle="tooltip" data-original-title="Delete" class="delete btn btn-warning">
    Delete
    </a>
    <a href="javascript:void(0)" data-toggle="tooltip" onClick="upDownFunc('{{ $mlearn_id }}','upgrade')" data-original-title="upgrade" class="edit btn btn-primary edit">
        Upgrade
        </a>
    <a href="javascript:void(0);" id="downgrade-compnay" onClick="upDownFunc( '{{ $mlearn_id }}','downgrade')" data-toggle="tooltip" data-original-title="downgrade" class="delete btn btn-danger">
        Downgrade
 </a>
