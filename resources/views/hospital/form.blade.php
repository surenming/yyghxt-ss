<div class="box-body">
    <div class="form-group {{empty($errors->first('name'))?'':'has-error'}}">
        <label for="name" class="col-sm-2 control-label"><span class="text-red">*</span> 标识</label>
        <div class="col-sm-8">
            <input type="text" id="name" name="name" class="form-control" {{isset($hospital)?'disabled':''}} placeholder="{{empty($errors->first('name'))?'英文或拼音 eg:slug':$errors->first('name')}}" value="{{isset($hospital)?$hospital->name:old('name')}}">
        </div>
    </div>
    <div class="form-group {{empty($errors->first('display_name'))?'':'has-error'}}">
        <label for="displayName" class="col-sm-2 control-label"><span class="text-red">*</span> 名称</label>
        <div class="col-sm-8">
            <input type="text" id="displayName" name="display_name" class="form-control" placeholder="{{empty($errors->first('display_name'))?'名称':$errors->first('display_name')}}" value="{{isset($hospital)?$hospital->display_name:old('display_name')}}">
        </div>
    </div>
    <div class="form-group {{empty($errors->first('tel'))?'':'has-error'}}">
        <label for="tel" class="col-sm-2 control-label">电话</label>
        <div class="col-sm-8">
            <input type="text" id="tel" name="tel" class="form-control" placeholder="{{empty($errors->first('tel'))?'电话':$errors->first('tel')}}" value="{{isset($hospital)?$hospital->tel:old('tel')}}">
        </div>
    </div>
    <div class="form-group {{empty($errors->first('qq'))?'':'has-error'}}">
        <label for="qq" class="col-sm-2 control-label">QQ</label>
        <div class="col-sm-8">
            <input type="text" id="qq" name="qq" class="form-control" placeholder="{{empty($errors->first('qq'))?'QQ':$errors->first('qq')}}" value="{{isset($hospital)?$hospital->qq:old('qq')}}">
        </div>
    </div>
    <div class="form-group {{empty($errors->first('wechat'))?'':'has-error'}}">
        <label for="wechat" class="col-sm-2 control-label">微信</label>
        <div class="col-sm-8">
            <input type="text" id="wechat" name="wechat" class="form-control" placeholder="{{empty($errors->first('wechat'))?'微信':$errors->first('wechat')}}" value="{{isset($hospital)?$hospital->wechat:old('wechat')}}">
        </div>
    </div>
    <div class="form-group {{empty($errors->first('wechat'))?'':'has-error'}}">
        <label for="addr" class="col-sm-2 control-label">地址</label>
        <div class="col-sm-8">
            <input type="text" id="addr" name="addr" class="form-control" placeholder="{{empty($errors->first('addr'))?'地址':$errors->first('addr')}}" value="{{isset($hospital)?$hospital->addr:old('addr')}}">
        </div>
    </div>
    <div class="form-group {{empty($errors->first('description'))?'':'has-error'}}">
        <label for="description" class="col-sm-2 control-label">描述</label>
        <div class="col-sm-8">
            <textarea id="description" name="description" class="form-control" rows="3">{{isset($hospital)?$hospital->description:old('description')}}</textarea>
        </div>
    </div>
</div>
<div class="box-footer">
    <div class="form-group">
        <div class="col-sm-10">
            <button type="submit" class="btn btn-info pull-right">提交</button>
        </div>
    </div>
</div>