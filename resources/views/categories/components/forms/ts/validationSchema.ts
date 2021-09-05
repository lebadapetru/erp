import { boolean, object, string } from "yup";

const validationSchema = object().shape({
  title: string().trim().required('Title is required.'),
  description: string(),
  isPublic: boolean(),
});

export default validationSchema