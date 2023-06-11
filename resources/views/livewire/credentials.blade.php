<div class="table-responsive">
  <table class="table table-fixed" id="customerCredentials" style="width: 100%; table-layout: fixed;">
    <thead>
      <tr>
        <th class="col-1 text-success">EntityNam</th>
        <th class="col-4 text-success">Login URL</th>
        <th class="col-1 text-success">Username</th>
        <th class="col-1 text-success">E_Password</th>
        <th class="col-5 text-success">Remarks</th>
        <th class="col-1 text-center">
          <button wire:click.prevent="addCredential" type="button" class="btn btn-sm bg-amber-900 text-white">Add Row</button>
        </th>
      </tr>
    </thead>
    <tbody>
      @foreach ($allCredentials as $index => $allCredential)
      <tr>
        <td>
          <input type="text" name="allCredentials[{{$index}}][entity_name]" class="form-control" wire:model="allCredentials.{{$index}}.entity_name" />
        </td>
        <td>
          <input type="text" name="allCredentials[{{$index}}][login_url]" class="form-control" wire:model="allCredentials.{{$index}}.login_url" />
        </td>
        <td>
          <input type="text" name="allCredentials[{{$index}}][username]" class="form-control" wire:model="allCredentials.{{$index}}.username" />
        </td>
        <td>
          <input type="text" name="allCredentials[{{$index}}][password]" class="form-control" wire:model="allCredentials.{{$index}}.password" />
        </td>
        <td>
          <input type="text" name="allCredentials[{{$index}}][remarks]" class="form-control" wire:model="allCredentials.{{$index}}.remarks" />
        </td>
        <td class="text-center">
          <button type="button" class="btn btn-sm bg-red-500 text-white" wire:click.prevent="removeCredential({{$index}})">Delete</button>
          <button type="button" class="btn btn-sm bg-gray-500 text-white" onclick="openUrl2(this)">OpenUrl</button>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>