{{--
    Permission checkboxes for the role create/edit forms. Keeps #kt_roles_select_all
    and .kt-role-permission-checkbox, which resources/js/modules/role-permissions.js targets.
    Expects $permissions and $selected (array of permission names).
--}}
<fieldset>
    <legend class="fs-6 fw-bold">Permissions</legend>
    @if ($permissions->isEmpty())
        <p class="text-body-secondary mb-0">No permissions exist yet. <a href="{{ route('admin.permissions.index') }}">Create permission</a></p>
    @else
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="kt_roles_select_all"
                @checked(count($selected) === $permissions->count())>
            <label class="form-check-label" for="kt_roles_select_all">Select all</label>
        </div>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-3">
            @foreach ($permissions as $permission)
                <div class="col">
                    <div class="form-check">
                        <input class="form-check-input kt-role-permission-checkbox" type="checkbox" name="permissions[]"
                            id="permission-{{ $permission->id }}" value="{{ $permission->name }}"
                            @checked(in_array($permission->name, $selected, true))>
                        <label class="form-check-label" for="permission-{{ $permission->id }}">{{ $permission->name }}</label>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    @if ($errors->has('permissions') || $errors->has('permissions.*'))
        <div class="invalid-feedback d-block">{{ $errors->first('permissions') ?: $errors->first('permissions.*') }}</div>
    @endif
</fieldset>
