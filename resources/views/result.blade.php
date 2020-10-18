<form method="POST" action="{{route('resultValidate')}}" id="form">
    {{csrf_field()}}
    <div class="row mb-3">
        <div class="col-lg-12" style="min-height: 1.5rem; color: red">
            {{$error}}
        </div>
    </div>
    <div class="form-row">
        <label for="description">Описание задачи</label>
    </div>
    <div class="form-row mb-3">
        <input type="text" name="email" id="email" />
    </div>
    <div class="form-row mb-3">
        <input type="text" name="user_fields" id="user_fields" />
    </div>
    <div class="form-row mb-3">
        <input type="text" name="site_url" id="user_fields" />
    </div>

    <select id="multiselect" name="multiselect[]" multiple>
        <option value=""></option>
        <option value="msk">Moskow</option>
        <option value="msk">Moskow</option>
        <option value="paris">Paris</option>
        <option value="london">London</option>
        <option value="ny">New York</option>
    </select>

    <div class="form-row mb-3">
        <button type="submit" class="btn btn-primary">Проверить заполнение</button>
    </div>
</form>
