<form id="update-user-in-group" action="{{route('addUserGroup')}}" type="POST">
  <div class="form-group">
    <div class="row">
      <div class="col-md-9">
        <select name="userId" id="select_add_user" class="form-control select2">
          @foreach($candidateUsers as $user)
          <option value="{{$user->id}}">{{$user->username}} - <strong>{{$user->full_name}}</strong></option>
          @endforeach
        </select>
      </div>

      <div class="col-md-3">
        <input type="hidden" name="groupId" value="{{$group->id}}" />
        <button type="submit" class="btn btn-info"><i class="fa fa-pencil"></i> {{trans('all.add')}}</button>
      </div>
    </div>
  </div>
  </form>

<table class="table table-striped table-bordered table-hover" id="ajax-data-table">
  <thead>
  <tr>
  <th style="width: 10%!important;">Id</th>
  <th style="width: 35%!important;">{{trans('all.username')}}</th>
  <th style="width: 35%!important;">{{trans('all.full-name')}}</th>
  <th style="width: 20%!important;">{{trans('all.actions')}}</th>
  </tr>
  </thead>
  <tbody>
  @foreach($usersInGroup as $user)
  <tr class="odd gradeX" id="row-user-in-group-{{$user->id}}">
  <td>{{$user->id}}</td>
  <td>{{$user->username}}</td>
  <td>{{$user->full_name }}</td>
  <td>
      <a href="{{route('showUser', $user->id)}}" class="ajaxify-child-page btn btn-default btn-xs purple"><i class="fa fa-edit"></i> Edit</a>
      <a href="{{route('deleteUserGroup', array($group->id, $user->id))}}" class="btn btn-default btn-xs black remove-user"><i class="fa fa-trash-o"></i> Delete</a>
  </td>
  </tr>
  @endforeach
  </tbody>
</table>