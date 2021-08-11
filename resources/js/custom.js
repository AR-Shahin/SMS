
window.myFun = (params) => {
    Swal.fire(params)
}
globalThis.base_path = window.location.origin
globalThis.setSuccessMessage = (title = 'Data Save Successfully!') => {
    Swal.fire(
    'Success!',
    title,
    'success'
    )
}

globalThis.setErrorMessage = () => {
    Swal.fire(
    'Error!',
    'Something Went Wrong!!',
    'error'
    )
}
