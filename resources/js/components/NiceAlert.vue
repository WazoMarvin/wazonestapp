

<script>
import Swal from 'sweetalert2'
export default {
    data() {
        return {
            
        }
    },
    props:{
        SwalIcon:{
            required:true,
            type:String
        },
        SwalMessage:{
            required:true,
            type:String
        }
    },
    mounted() {
        Swal.fire({
            position: 'center',
            icon: this.SwalIcon,
            title: this.SwalMessage,
            showConfirmButton: true
        })
    },
}
</script>