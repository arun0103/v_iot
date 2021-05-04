<template>
    <div class="content">
        <div class="card">
            <div class="card-header"><h3>@{{user.name}}'s Profile</h3>
                <span style="float:right; position:absolute; top:10px;right:10px">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#profile_edit_modal">Edit</button></span>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <img id="img_avatar_preview" :src="'/uploads/avatars/'+ user.avatar != null? user.avatar : 'default-avatar.png'" style="width:150px; height:150px; float: left; border-radius:50%; margin-right:25px">
                        <button id="btn_change_avatar" type="button" class="btn btn-primary" data-toggle="modal" data-target="#avatar_edit_modal" style="position:absolute; left:55px;bottom:30px;">Change</button>
                    </div>
                    <div class="col-md-6" style="margin-left:20px">
                        <h5 style="text-decoration:underline">Personal Information</h5>
                        <table>
                            <tr><th>Name</th>               <td>&nbsp;:&nbsp;</td>  <td>@{{user.name}}</td></tr>
                            <tr><th>Email</th>               <td>&nbsp;:&nbsp;</td>  <td>@{{user.email}}</td></tr>
                        </table>

                    </div>
                </div>

            </div>
        </div>
    </div>

</template>
<script>
    export default{
        data(){
            return{
                'user': [],
            }

        },
        mounted(){
            axios.get('api/getUserProfile').then((response)=>function(){
                console.log(response);
            })
        }
    }
</script>