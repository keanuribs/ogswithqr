// script.js

document.addEventListener('DOMContentLoaded', function () {
  var inputFieldsContainer = document.getElementById('inputFieldsContainer');
  var submitBtn = document.getElementById('submitBtn');
  var addSubjectsLink = document.getElementById('addSubjectsLink');

  submitBtn.addEventListener('click', generateFields);
  addSubjectsLink.addEventListener('click', addSubjectInput);


function generateFields() {
  var numberOfFields = document.getElementById('numberOfFields').value;
  inputFieldsContainer.innerHTML = ''; // Clear previous fields

  for (var i = 1; i <= numberOfFields; i++) {
      var inputFieldGroup = document.createElement('div');
      inputFieldGroup.className = 'input-field-group';

      var subjectCodeField = document.createElement('div');
      subjectCodeField.className = 'input-field';
      subjectCodeField.innerHTML = `
          <label>Subject Code<span style="font-size: smaller; font-style: italic;" >(e.g. DCIT 50A)</span></label>
          <input type="text" placeholder="Enter subject Code" required>
      `;
      inputFieldGroup.appendChild(subjectCodeField);

      var courseCodeField = document.createElement('div');
      courseCodeField.className = 'input-field';
      courseCodeField.innerHTML = `
          <label>Course Code<span style="font-size: smaller; font-style: italic;" >(e.g. DCIT 50A)</span></label>
          <input type="text" placeholder="Enter course Code" required readonly>
      `;
      inputFieldGroup.appendChild(courseCodeField);

      var courseDescriptionField = document.createElement('div');
      courseDescriptionField.className = 'input-field';
      courseDescriptionField.innerHTML = `
          <label>Course Description<span style="font-size: smaller; font-style: italic;" >(e.g. DCIT 50A)</span></label>
          <input type="text" placeholder="Enter course Description" required readonly>
      `;
      inputFieldGroup.appendChild(courseDescriptionField);

      inputFieldsContainer.appendChild(inputFieldGroup);
  }
}




});
