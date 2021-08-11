
window.myFun = (params) => {
    Swal.fire(params)
}

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
