const copyToClipboard = str => {
    if (navigator && navigator.clipboard && navigator.clipboard.writeText)
      return navigator.clipboard.writeText(str);
    return Promise.reject('The Clipboard API is not available.');
};

document.onreadystatechange = function () {
  if (document.readyState === 'interactive') {
    const saittech_ptalc_copy = document.getElementById('saittech-ptalc');
    saittech_ptalc_copy?.querySelector('.saittech_ptalc_copy_clip')
    .addEventListener('click', () => copyToClipboard(saittech_ptalc_copy.querySelector('.saittech_ptalc_copy')?.textContent)
    )
  }
}