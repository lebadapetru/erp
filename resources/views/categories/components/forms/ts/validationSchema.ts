import { object, string } from "yup";

const validationSchema = object().shape({
  title: string().trim().required('Title is required.'),
  description: string(),
});

export default validationSchema