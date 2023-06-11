<div class="table-responsive">
  <table class="table table-fixed" style="width: 100%; table-layout: fixed;">
    <thead>
      <tr>
        <th class="col-1 text-success">EntityNam</th>
        <th class="col-4 text-success">Login URL</th>
        <th class="col-1 text-success">Username</th>
        <th class="col-1 text-success">E_Password</th>
        <th class="col-5 text-success">Remarks</th>
        <th class="col-1 text-center">
          <button wire:click="addTableRow()" type="button" class="btn btn-warning btn-sm text-primary" >Add Row</button>
        </th>
      </tr>
    </thead>
    <tbody id="credentialtable">
      @foreach ($credentials as $credential)
      <tr>
        <td>
          <input type="text" class="form-control" value="{{ $credential->entity_name }}">
        </td>
        <td>
          <input type="text" class="form-control" value="{{ $credential->login_url }}">
        </td>

        <td>
          <input type="text" class="form-control" value="{{ $credential->username }}">
        </td>

        <td>
          <input type="text" class="form-control" value="{{ $credential->password }}">
        </td>

        <td>
          <input type="text" class="form-control" value="{{ $credential->remarks }}">
        </td>
        <td class="text-center">
          <button type="button" class="btn btn-danger" onclick="deleteRow(this)">Del</button>
          <button type="button" class="btn btn-info" onclick="openUrl(this)">Url</button>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>